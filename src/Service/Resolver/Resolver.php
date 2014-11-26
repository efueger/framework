<?php

namespace Framework\Service\Resolver;

use Closure;
use Framework\Config\Configuration;
use Framework\Event\Event;
use Framework\Service\Config\Args\Arguments;
use Framework\Service\Config\Call\ServiceCall;
use Framework\Service\Config\Calls\ServiceCalls;
use Framework\Service\Config\Child\ChildService;
use Framework\Service\Config\ConfigLink\ConfigServiceLink;
use Framework\Service\Config\Configuration as Config;
use Framework\Service\Config\Dependency\ServiceDependency;
use Framework\Service\Config\Factory\ServiceFactory;
use Framework\Service\Config\Filter\ServiceFilter;
use Framework\Service\Config\Invokable\ServiceInvokable;
use Framework\Service\Config\Invoke\ServiceInvoke;
use Framework\Service\Config\Param\ServiceParam;
use Framework\Service\Config\ServiceConfig\ServiceConfiguration;
use Framework\Service\Config\ServiceManagerLink\ServiceManager;
use ReflectionClass;
use RuntimeException;

trait Resolver
{
    /**
     *
     */
    use Signal;

    /**
     * @param $args
     * @return mixed
     */
    protected function args($args)
    {
        if (!$args) {
            return $args;
        }

        if (!is_array($args)) {
            return $this->resolve($args);
        }

        foreach($args as $index => $value) {
            if ($value instanceof Resolvable) {
                $args[$index] = $this->resolve($value);
            }
        }

        return $args;
    }

    /**
     * @param array|callable|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     * @throws RuntimeException
     */
    public function call($config, array $args = [], callable $callback = null)
    {
        if (!is_string($config)) {
            return $config instanceof Event ? $this->trigger($config, $args, $callback ?: $this)
                : $this->invoke($config, $args, $callback);
        }

        $config = explode(Args::CALL_SEPARATOR, $config);
        $plugin = array_shift($config);
        $method = array_pop($config);

        $plugin = $this->plugin($plugin, function($plugin) {
            if (!is_callable($plugin)) {
                throw new RuntimeException('Plugin is not callable: ' . $plugin);
            }

            return $plugin;
        });

        if ($plugin instanceof Event) {
            return $this->trigger($plugin, $args, $callback ?: $this);
        }

        foreach($config as $name) {
            $plugin = $this->invoke([$plugin, $name], $args, $callback);
        }

        return $this->invoke($method ? [$plugin, $method] : $plugin, $args, $callback);
    }

    /**
     * @param ChildService $config
     * @param array $args
     * @return null|object
     */
    protected function child(ChildService $config, array $args = [])
    {
        return $this->provide($this->merge(clone $this->configured($this->resolve($config->parent())), $config), $args);
    }

    /**
     * @return Configuration
     */
    public abstract function config();

    /**
     * @param string $name
     * @return mixed
     */
    public abstract function configured($name);

    /**
     * @param array|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|null|object
     */
    protected abstract function create($config, array $args = [], callable $callback = null);

    /**
     * @param $arg
     * @param array $filters
     * @return mixed
     */
    protected function filter($arg, array $filters)
    {
        foreach($filters as $filter) {
            $arg = $filter($arg);
        }

        return $arg;
    }

    /**
     * @param string $name
     * @return null|object|callable
     */
    public abstract function get($name);

    /**
     * @param Config $config
     * @param $service
     * @return mixed
     */
    protected function hydrate(Config $config, $service)
    {
        foreach($config->calls() as $method => $value) {
            if (is_string($method)) {
                if (Args::PROPERTY == $method[0]) {
                    $service->{substr($method, 1)} = $this->resolve($value);
                    continue;
                }

                $service->$method($this->resolve($value));
                continue;
            }

            if (is_array($value)) {
                list($method, $args) = $value;

                if (!is_string($method)) {
                    $this->invoke($method, $args);
                    continue;
                }

                is_string($args) ? $this->invoke($value) : $this->invoke([$service, $method], $args);
                continue;
            }

            $this->resolve($value);
        }

        return $service;
    }

    /**
     * @param callable|string $config
     * @return callable|null
     */
    protected function invokable($config)
    {
        if (is_string($config) && Args::CALL === $config[0]) {
            return function($args = []) use ($config) {
                return $this->call(
                    substr($config, 1),
                    !is_array($args) || !is_string(key($args)) ? func_get_args() : $args
                );
            };
        }

        if (is_array($config)) {
            return is_string($config[0]) ? $config : [$this->create($config[0]), $config[1]];
        }

        if ($config instanceof Closure) {
            return $config;
        }

        return $this->create($config);
    }

    /**
     * @param array|object|string $config
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected function invoke($config, array $args = [], callable $callback = null)
    {
        return $this->signal($this->args($config), $this->args($args), $callback ?: $this);
    }

    /**
     * @param Config $parent
     * @param Config $config
     * @return Config
     */
    protected function merge(Config $parent, Config $config)
    {
        !$parent->name() && $parent->set(Config::NAME, $this->resolve($config->name()));

        $config->args() && $parent->set(Config::ARGS, $config->args());

        $config->calls() && $parent->set(
            Config::CALLS,
            $config->merge() ? array_merge($parent->calls(), $config->calls()) : $config->calls()
        );

        return $parent;
    }

    /**
     * @param string $name
     * @param array $args
     * @return object
     */
    protected function newInstanceArgs($name, array $args = [])
    {
        if (!$args) {
            return new $name;
        }

        $class = new ReflectionClass($name);

        return $class->hasMethod('__construct') ? $class->newInstanceArgs($this->args($args)) : $class->newInstance();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function param($name)
    {
        $name  = explode(Args::CALL_SEPARATOR, $name);
        $value = $this->config()->get(array_shift($name));

        foreach($name as $n) {
            $value = $value[$n];
        }

        return $value;
    }

    /**
     * @param string $name
     * @param callable $callback
     * @return callable|null|object
     */
    protected abstract function plugin($name, callable $callback = null);

    /**
     * @param Config $config
     * @param array $args
     * @return null|object
     */
    protected function provide(Config $config, array $args = [])
    {
        $name   = $this->solve($config->name());
        $parent = $this->configured($name);

        !$args && $args = $config->args();

        if ($parent && !$parent instanceof Config) {
            return $this->hydrate($config, $this->newInstanceArgs($this->solve($parent), $args));
        }

        if (!$parent || $name == $parent->name()) {
            return $this->hydrate($config, $this->newInstanceArgs($name, $args));
        }

        return $this->provide($this->merge(clone $parent, $config), $args);
    }

    /**
     * @param $config
     * @param array $args
     * @return null|object
     */
    protected function resolve($config, array $args = [])
    {
        if (!$config instanceof Resolvable) {
            return $config;
        }

        if ($config instanceof ServiceFactory) {
            return $this->invoke($this->child($config, $args));
        }

        if ($config instanceof ServiceCalls) {
            return $this->hydrate($config, $this->resolve($config->name(), $args));
        }

        if ($config instanceof ChildService) {
            return $this->child($config, $args);
        }

        if ($config instanceof Config) {
            return $this->provide($config, $args);
        }

        if ($config instanceof ServiceDependency) {
            return $this->get($config->name());
        }

        if ($config instanceof ServiceParam) {
            return $this->resolve($this->param($config->name()));
        }

        if ($config instanceof ServiceCall) {
            return $this->call($config->config(), $config->args());
        }

        if ($config instanceof Arguments) {
            return $this->args($config->config());
        }

        if ($config instanceof ConfigServiceLink) {
            return $this->config();
        }

        if ($config instanceof ServiceManager) {
            return $this;
        }

        if ($config instanceof ServiceFilter) {
            return $this->filter($this->resolve($config->config()), $config->filter());
        }

        if ($config instanceof ServiceConfiguration) {
            return $this->configured($config->name());
        }

        if ($config instanceof ServiceInvoke) {
            return function(array $args = []) use ($config) {
                return $this->call($config->config(), $config->args() + $args);
            };
        }

        if ($config instanceof ServiceInvokable) {
            return function() use ($config) {
                return $this->solve($config->config());
            };
        }

        return $config;
    }

    /**
     * @param $config
     * @return mixed
     */
    protected function solve($config)
    {
        return $config instanceof Resolvable ? $this->solve($this->resolve($config)) : $config;
    }

    /**
     * @param string $event
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected abstract function trigger($event, array $args = [], callable $callback = null);

    /**
     * @param string $name
     * @param callable $callback
     * @return mixed
     */
    public function __invoke($name, callable $callback = null)
    {
        return $this->plugin($name, $callback);
    }
}
