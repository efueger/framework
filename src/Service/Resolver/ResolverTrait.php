<?php

namespace Framework\Service\Resolver;

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
     * @param callable|string $config
     * @param array $args
     * @return mixed
     */
    protected function call($config, array $args = [])
    {
        /** @var ManagerInterface|self $this */

        $config = explode('.', $config);

        $call  = $args ? array_pop($config) : null;
        $value = $this->get(array_shift($config));

        foreach($config as $method) {
            $value = $value->$method();
        }

        return $args ? $this->invoke([$value, $call], $args) : $value;
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
        return $this->di($this->merge(clone $this->configured($this->resolve($config->parent())), $config), $args);
    }

    /**
     * @param Config $config
     * @param array $args
     * @return null|object
     */
    protected function di(Config $config, array $args = [])
    {
        /** @var ManagerInterface|self $this */

        $args = $args ? : $config->args();
        $name = $config->name();

        $parent = $this->configured($name);

        if (!$parent || $config->name() == $parent->name()) {
            return $this->hydrate($config, $this->newInstanceArgs($name, $this->args($args)));
        }

        return $this->di($this->merge(clone $parent, $config), $args);
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
                if ('$' == $method[0]) {
                    $service->{substr($method, 1)} = $this->resolve($value);
                    continue;
                }

                $service->$method($this->resolve($value));
                continue;
            }

            if (is_object($value)) {
                $this->invoke($value);
                continue;
            }

            $args = isset($value[1]) ? (array) $value[1] : [];

            if (is_string($value[0])) {
                $this->invoke([$service, $value[0]], $args);
                continue;
            }

            $this->invoke($value[0], $args);
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
        return call_user_func_array($this->args($config), $this->args($args));
    }

    /**
     * @param Config $parent
     * @param Config $config
     * @return Config
     */
    protected function merge(Config $parent, Config $config)
    {
        /** @var Child|Config $config */

        $parent->add(Config::NAME, $parent->name() ? : $this->resolve($config->name()));


        if ($config->args()) {
            $parent->add(Config::ARGS, $config->args());
        }

        $calls = $config->calls();

        if (!$calls) {
            return $parent;
        }

        $parent->add(Config::CALLS, $config->merge() ? array_merge($parent->calls(), $calls) : $calls);

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
     * @param array|string $config
     * @param array $args
     * @return array
     */
    protected function options($config, array $args = [])
    {
        return is_array($config) ? [array_shift($config), $config] : [$config, $args];
    }

    /**
     * @param $name
     * @return mixed
     */
    protected function param($name)
    {
        /** @var ManagerInterface|self $this */

        $name = explode('.', $name);

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

        if ($config instanceof Factory) {
            return $this->invoke($this->child($config, $args));
        }

        if ($config instanceof Child) {
            return $this->child($config, $args);
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

        if ($config instanceof Filter) {
            return $this->filter($this->resolve($config->config()), $config->filter());
        }

        if ($config instanceof ConfigLink) {
            return $this->config();
        }

        if ($config instanceof ServiceManagerLink) {
            return $this;
        }

        if ($config instanceof Invoke) {
            return function() use ($config) {
                return $this->invoke($config->config(), $config->args() ?: func_get_args());
            };
        }

        if ($config instanceof Config) {
            return $this->di($config);
        }

        return $config;
    }
}