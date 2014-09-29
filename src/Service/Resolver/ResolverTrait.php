<?php

namespace Framework\Service\Resolver;

use Framework\Config\ConfigInterface;
use Framework\Service\Config\Args\ArgsInterface as Args;
use Framework\Service\Config\Call\CallInterface as Call;
use Framework\Service\Config\Child\ChildInterface as Child;
use Framework\Service\Config\ConfigInterface as Config;
use Framework\Service\Config\ConfigLink\ConfigLinkInterface as ConfigLink;
use Framework\Service\Config\Dependency\DependencyInterface as Dependency;
use Framework\Service\Config\Filter\FilterInterface as Filter;
use Framework\Service\Config\Param\ParamInterface as Param;
use Framework\Service\Config\ServiceManagerLink\ServiceManagerLinkInterface as ServiceManagerLink;
use Framework\Service\Manager\ManagerInterface;

trait ResolverTrait
{
    /**
     * @param mixed $arg
     * @return mixed
     */
    protected function arg($arg)
    {
        /** @var ManagerInterface|self $this */

        if (!is_object($arg)) {
            return $arg;
        }

        if ($arg instanceof Child) {
            /** @var Child|Config $arg */

            $parent = clone $this->configured($this->arg($arg->parent()));

            $parent->add(Config::NAME, $this->arg($arg->name()));

            return $this->resolve($parent);
        }

        if ($arg instanceof Config) {
            return $this->resolve($arg);
        }

        if ($arg instanceof Dependency) {
            return $this->get($arg->name());
        }

        if ($arg instanceof Param) {
            return $this->arg($this->param($arg->name()));
        }

        if ($arg instanceof Call) {
            return $this->call($arg->config(), $arg->args());
        }

        if ($arg instanceof Args) {
            return $this->args($arg->config());
        }

        if ($arg instanceof Filter) {
            return $this->filter($this->arg($arg->config()), $arg->filter());
        }

        if ($arg instanceof ConfigLink) {
            return $this->config();
        }

        if ($arg instanceof ServiceManagerLink) {
            return $this;
        }

        return $arg;
    }

    /**
     * @param $args
     * @return mixed
     */
    protected function args($args)
    {
        if (!is_array($args)) {
            return $this->arg($args);
        }

        foreach($args as $index => $value) {
            $args[$index] = $this->arg($value);
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

        $name = explode('.', $config);

        $call  = $args ? array_pop($name) : null;
        $value = $this->get(array_shift($name));

        foreach($name as $method) {
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
        $config->add(Config::NAME, $this->arg($config->name()));

        return $this->resolve($this->merge($config, $this->configured($config->parent())), $args);
    }

    /**
     * @param array|object|string $config
     * @param array $args
     * @return callable|null|object
     */
    abstract protected function create($config, array $args = []);

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
                    $service->{substr($method, 1)} = $this->arg($value);
                    continue;
                }

                $service->$method($this->arg($value));
                continue;
            }

            if (is_object($value)) {
                $this->invoke($value);
                continue;
            }

            if (is_string($value[0])) {
                $this->invoke([$service, $value[0]], $value[1]);
                continue;
            }

            $this->invoke($value[0], $value[1]);
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
    abstract protected function newInstanceArgs($name, array $args = []);

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
     * @param Config $config
     * @param array $args
     * @return null|object
     */
    protected function resolve(Config $config, array $args = [])
    {
        /** @var ManagerInterface|self $this */

        $args = $args ? : $config->args();
        $name = $config->name();

        $parent = $this->configured($name);

        if (!$parent || $config->name() == $parent->name()) {
            return $this->hydrate($config, $this->newInstanceArgs($name, $this->args($args)));
        }

        return $this->resolve($this->merge(clone $parent, $config), $args);
    }
}