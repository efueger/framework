<?php

namespace Framework\Service\Resolver;

use Closure;
use Framework\Config\Configuration;
use Framework\Event\Event as Event;
use Framework\Service\AliasTrait as Alias;
use Framework\Service\Config\Args\Arguments as Args;
use Framework\Service\Config\Call\ServiceCall as Call;
use Framework\Service\Config\Child\Config as Child;
use Framework\Service\Config\Configuration as Config;
use Framework\Service\Config\ConfigLink\ConfigServiceLink as ConfigLink;
use Framework\Service\Config\Dependency\ServiceDependency as Dependency;
use Framework\Service\Config\Factory\ServiceFactory as Factory;
use Framework\Service\Config\Filter\ServiceFilter as Filter;
use Framework\Service\Config\Invoke\ServiceInvoke as Invoke;
use Framework\Service\Config\Param\ServiceParam as Param;
use Framework\Service\Config\ServiceManagerLink\ManagerLink as ServiceManagerLink;
use Framework\Service\Container\ServiceTrait as Container;
use ReflectionClass;
use RuntimeException;

trait ResolverTrait
{
    /**
     *
     */
    use Alias;
    use Container;
    use SignalTrait;

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
            $args[$index] = $this->resolve($value);
        }

        return $args;
    }

    /**
     * @param array|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     * @throws RuntimeException
     */
    public function call($config, array $args = [], callable $callback = null)
    {
        if (!is_string($config)) {
            return $this->invoke($config, $args, $callback);
        }

        $config = explode(ResolverArgs::CALL_SEPARATOR, $config);
        $plugin = array_shift($config);
        $method = $config ? array_pop($config) : null;

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
            $plugin = $plugin->$name();
        }

        return $this->invoke($method ? [$plugin, $method] : $plugin, $args, $callback);
    }

    /**
     * @param Child $config
     * @param array $args
     * @return null|object
     */
    protected function child(Child $config, array $args = [])
    {
        /** @var Child|Config $config */
        return $this->provide($this->merge(clone $this->configured($this->resolve($config->parent())), $config), $args);
    }

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
     * @param Config $config
     * @param $service
     * @return mixed
     */
    protected function hydrate(Config $config, $service)
    {
        foreach($config->calls() as $method => $value) {
            if (is_string($method)) {
                if (ResolverArgs::PROPERTY == $method[0]) {
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
        if ($config instanceof Closure) {
            return $config->bindTo($this);
        }

        if (is_string($config) && ResolverArgs::CALL === $config[0]) {
            return function($args = []) use ($config) {
                /** @var callable|self $this */
                return $this->call(
                    substr($config, 1),
                    !is_array($args) || !is_string(key($args)) ? func_get_args() : $args,
                    $this
                );
            };
        }

        if (is_array($config)) {
            return is_string($config[0]) ? $config : [$this->create($config[0]), $config[1]];
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
        return $this->signal($this->args($config), $this->args($args), $callback);
    }

    /**
     * @param Config $parent
     * @param Config $config
     * @return Config
     */
    protected function merge(Config $parent, Config $config)
    {
        /** @var Child|Config $config */

        $parent->set(Config::NAME, $parent->name() ? : $this->resolve($config->name()));

        $config->args() && $parent->set(Config::ARGS, $config->args());

        $calls = $config->calls();

        if (!$calls) {
            return $parent;
        }

        $parent->set(Config::CALLS, $config->merge() ? array_merge($parent->calls(), $calls) : $calls);

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

        return $class->hasMethod('__construct') ? $class->newInstanceArgs($args) : $class->newInstance();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function param($name)
    {
        $name = explode(ResolverArgs::CALL_SEPARATOR, $name);

        $value = $this->config()->get(array_shift($name));

        foreach($name as $n) {
            $value = $value instanceof Configuration ? $value->get($n) : $value[$n];
        }

        return $value;
    }

    /**
     * @param $name
     * @param callable $callback
     * @return callable|null|object
     */
    public function plugin($name, callable $callback = null)
    {
        $alias = $this->alias($name);

        if ($alias && ResolverArgs::CALL === $alias[0]) {
            return function(array $args = []) use ($alias) {
                return $this->call(substr($alias, 1), $args, $this);
            };
        }

        return $this->get($alias ?: $name, [], $callback ?: function() {});
    }

    /**
     * @param Config $config
     * @param array $args
     * @return null|object
     */
    protected function provide(Config $config, array $args = [])
    {
        $args = $args ? : $config->args();
        $name = $config->name();

        $parent = $this->configured($name);

        if (!$parent || $config->name() == $parent->name()) {
            return $this->hydrate($config, $this->newInstanceArgs($name, $this->args($args)));
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
        /** @var Config|Child|Filter $config */

        if (!is_object($config)) {
            return $config;
        }

        if ($config instanceof Factory) {
            return $this->invoke($this->child($config, $args), [], $this);
        }

        if ($config instanceof Child) {
            return $this->child($config, $args);
        }

        if ($config instanceof Config) {
            return $this->provide($config, $args);
        }

        if ($config instanceof Dependency) {
            return $this->get($config->name());
        }

        if ($config instanceof Param) {
            return $this->resolve($this->param($config->name()));
        }

        if ($config instanceof Call) {
            return $this->call($config->config(), $config->args());
        }

        if ($config instanceof Args) {
            return $this->args($config->config());
        }

        if ($config instanceof ConfigLink) {
            return $this->config();
        }

        if ($config instanceof ServiceManagerLink) {
            return $this;
        }

        if ($config instanceof Filter) {
            return $this->filter($this->resolve($config->config()), $config->filter());
        }

        if ($config instanceof Invoke) {
            return function(array $args = []) use ($config) {
                return $this->invoke($config->config(), $config->args() + $args, $this);
            };
        }

        return $config;
    }

    /**
     * @param string $event
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected abstract function trigger($event, array $args = [], callable $callback = null);

    /**
     * @param $name
     * @param array $args
     * @return callable|mixed|null|object
     */
    public function __call($name, array $args = [])
    {
        return $this->call($name, $args ? array_shift($args) : []);
    }

    /**
     * @param string $plugin
     * @param callable $callback
     * @return mixed
     */
    public function __invoke($plugin, callable $callback = null)
    {
        return $this->plugin($plugin, $callback);
    }
}
