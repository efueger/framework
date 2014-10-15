<?php

namespace Framework\Service\Resolver;

use Exception;
use Framework\Config\ConfigInterface;
use Framework\Service\Config\Args\ArgsInterface as Args;
use Framework\Service\Config\Call\CallInterface as Call;
use Framework\Service\Config\Child\ChildInterface as Child;
use Framework\Service\Config\ConfigInterface as Config;
use Framework\Service\Config\ConfigLink\ConfigLinkInterface as ConfigLink;
use Framework\Service\Config\Dependency\DependencyInterface as Dependency;
use Framework\Service\Config\Factory\FactoryInterface as Factory;
use Framework\Service\Config\Filter\FilterInterface as Filter;
use Framework\Service\Config\Invoke\InvokeInterface as Invoke;
use Framework\Service\Config\Param\ParamInterface as Param;
use Framework\Service\Config\ServiceManagerLink\ServiceManagerLinkInterface as ServiceManagerLink;
use Framework\Service\Manager\ManagerInterface;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;

trait ResolverTrait
{
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
     * @return callable|mixed|null|object
     * @throws Exception
     */
    protected function call($config, array $args = [])
    {
        /** @var ManagerInterface|self $this */

        if (!is_string($config)) {
            return $this->invoke($config, $args);
        }

        $config = explode(ResolverInterface::SEPARATOR, $config);

        $call     = $args ? array_pop($config) : null;
        $callable = false;
        $name     = $config ? array_shift($config) : $call;

        $value  = $this->get($name, [], function($name) use(&$callable, $args) {
            $callable = true;

            if (!is_callable($name)) {
                throw new Exception('Callable not found: ' . $name);
            }

            return $this->invoke($name, $args);
        });

        if ($callable) {
            return $value;
        }

        foreach($config as $method) {
            $value = $value->$method();
        }

        return $args ? $this->invoke(!$config && $name == $call ? $value : [$value, $call], $args) : $value;
    }

    /**
     * @param Child $config
     * @param array $args
     * @return null|object
     */
    protected function child(Child $config, array $args = [])
    {
        /**
         * @var ManagerInterface|self $this
         * @var Child|Config $config
         */
        return $this->provide($this->merge(clone $this->configured($this->resolve($config->parent())), $config), $args);
    }

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
                if (ResolverInterface::PROPERTY == $method[0]) {
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

            $this->invoke($value);
        }

        return $service;
    }

    /**
     * @param array|object|string $config
     * @param array $args
     * @return mixed
     */
    protected function invoke($config, array $args = [])
    {
        if (!$args) {
            return call_user_func($this->args($config));
        }

        if (!is_string(key($args))) {
            $config = $this->args($config);

            if (!is_array($args[0]) || !isset($args[0][ResolverInterface::ARGS])) {
                return call_user_func_array($config, $this->args($args));
            }

            $args = $args[0][ResolverInterface::ARGS];
        }

        $method = ResolverInterface::INVOKE;

        if (is_array($config)) {
            if (is_string($config[0])) {
                return call_user_func($config, $args);
            }

            $method = isset($config[1]) ? $config[1] : $method;

            $config = $this->args($config[0]);
        }

        $callable = null;
        $matched  = [];
        $params   = null;

        if (is_string($config) && !class_exists($config)) {

            $static = explode(ResolverInterface::STATIC_STRING, $config);

            if ($static && isset($static[1])) {

                list($config, $method) = $static;

            } else {

                $params   = (new ReflectionFunction($config))->getParameters();
                $callable = $config;

            }
        }

        if (!$callable) {
            $params = (new ReflectionMethod($config, $method))->getParameters();
        }

        foreach($params as $param) {
            if (isset($args[$param->name])) {
                $matched[] = $args[$param->name];
                continue;
            }

            if (ResolverInterface::ARGUMENTS === $param->name && !isset($args[$param->name])) {
                $matched[] = $args;
                continue;
            }

            $matched[] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : $param->isArray() ? [] : null;
        }

        return call_user_func_array($callable ?: [$config, $method], $params ? $matched : $args);
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

        if ($config->args()) {
            $parent->set(Config::ARGS, $config->args());
        }

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
    protected function param($name)
    {
        /** @var ManagerInterface|self $this */

        $name = explode(ResolverInterface::SEPARATOR, $name);

        $value = $this->config()->get(array_shift($name));

        foreach($name as $n) {
            if ($value instanceof ConfigInterface) {
                $value = $value->get($n);
                continue;
            }

            $value = $value[$n];
        }

        return $value;
    }

    /**
     * @param Config $config
     * @param array $args
     * @return null|object
     */
    protected function provide(Config $config, array $args = [])
    {
        /** @var ManagerInterface|self $this */

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
        /**
         * @var Config|Child|Filter $config
         * @var ManagerInterface|self $this
         */

        if (!is_object($config)) {
            return $config;
        }

        if ($config instanceof Factory) {
            return $this->invoke($this->child($config, $args));
        }

        if ($config instanceof Child) {
            return $this->child($config, $args);
        }

        if ($config instanceof Config) {
            return $this->provide($config);
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
                return $this->invoke($config->config(), $config->args() + $args);
            };
        }

        return $config;
    }
}
