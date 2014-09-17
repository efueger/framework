<?php

namespace Framework\Service\Factory;

use Framework\Config\ConfigInterface;
use Framework\Service\Config\Args\ArgsInterface as Args;
use Framework\Service\Config\Call\CallInterface as Call;
use Framework\Service\Config\Child\ChildInterface as Child;
use Framework\Service\Config\ConfigInterface as Config;
use Framework\Service\Config\ConfigLink\ConfigLinkInterface as ConfigLink;
use Framework\Service\Config\Dependency\DependencyInterface as Dependency;
use Framework\Service\Config\FactoryInterface as ConfigFactory;
use Framework\Service\Config\Invoke\InvokeInterface as Invoke;
use Framework\Service\Config\Param\ParamInterface as Param;
use Framework\Service\Config\ServiceManagerLink\ServiceManagerLinkInterface as ServiceManagerLink;
use Framework\Service\Manager\ManagerInterface as ServiceManager;

class ServiceFactory
    implements FactoryInterface
{
    /**
     *
     */
    use ServiceTrait;

    /**
     * @var Config|ConfigFactory
     */
    protected $config;

    /**
     * @param ServiceManager $sm
     * @param Config|ConfigFactory $config
     */
    public function __construct(ServiceManager $sm, ConfigFactory $config)
    {
        $this->config = $config;
        $this->sm     = $sm;
    }

    /**
     * @param mixed $arg
     * @return mixed
     */
    protected function arg($arg)
    {
        if (!is_object($arg)) {
            return $arg;
        }

        if ($arg instanceof Child) {
            /** @var Child|Config $arg */

            $parent = clone $this->configured($this->arg($arg->parent()));

            $parent->add(Config::NAME, $this->arg($arg->name()));

            return $this->di($parent);
        }

        if ($arg instanceof Config) {
            return $this->configured($arg->name()) && $arg->shared() ? $this->get($arg->name()) : $this->di($arg);
        }

        if ($arg instanceof ConfigLink) {
            return $this->config();
        }

        if ($arg instanceof Dependency) {
            return $this->get($arg->name());
        }

        if ($arg instanceof ServiceManagerLink) {
            return $this->sm;
        }

        if ($arg instanceof Param) {
            return $this->arg($this->param($arg->name()));
        }

        if ($arg instanceof Call) {
            return $this->call($arg->config(), $this->args($arg->args()));
        }

        if ($arg instanceof Args) {
            return $this->args($arg->config());
        }

        return $arg;
    }

    /**
     * @param array $args
     * @return array
     */
    protected function args(array $args)
    {
        foreach($args as $index => $value) {
            $args[$index] = $this->arg($value);
        }

        return $args;
    }

    /**
     * @param $config
     * @param array $args
     * @return mixed
     */
    protected function call($config, array $args = [])
    {
        $name = explode('.', $config);

        $call  = $args ? array_pop($name) : null;
        $value = $this->get(array_shift($name));

        foreach($name as $method) {
            $value = $value->$method();
        }

        return $args ? call_user_func_array([$value, $call], $args) : $value;
    }

    /**
     * @param Config $config
     * @param array $args
     * @return null|object
     */
    protected function di(Config $config, array $args = [])
    {
        $args = $args ? : $config->args();
        $name = $config->name();

        $parent = $this->configured($name);

        if ($parent && !$parent instanceof Config) {
            return $this->hydrate($config, $this->create($name, $this->args($args)));
        }

        if (!$parent || $config->name() == $parent->name()) {
            return $this->hydrate($config, $this->newInstanceArgs($name, $this->args($args)));
        }

        return $this->di($this->merge(clone $parent, $config), $args);
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

            if (is_string($value[0])) {

                call_user_func_array([$service, $value[0]], $this->args($value[1]));

                continue;
            }

            call_user_func_array($this->args($value[0]), $this->args($value[1]));
        }

        return $service;
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
     * @param $name
     * @return mixed
     */
    protected function param($name)
    {
        $name = explode('.', $name);

        $value = $this->config()->get(array_shift($name));

        foreach($name as $n) {
            switch(true) {
                default:
                    $value = $value[$n];
                    break;
                case $value instanceof ConfigInterface:
                    $value = $value->get($n);
                    break;
            }
        }

        return $value;
    }

    /**
     * @return null|object
     */
    public function __invoke()
    {
        $config = $this->config;

        switch(true) {
            default:

                return $this->di($config, func_get_args());

                break;

            case $config instanceof ConfigLink:

                return $this->config();

                break;

            case $config instanceof Dependency:

                return $this->get($config->name());

                break;

            case $config instanceof ServiceManagerLink:

                return $this->sm;

                break;

            case $config instanceof Child:
                /** @var Child|Config $config */

                $config->add(Config::NAME, $this->arg($config->name()));

                return $this->di($this->merge($config, $this->configured($config->parent())), func_get_args());

                break;
            case $config instanceof Invoke:

                return function() use ($config) {
                    /** @var Config|Invoke $config */
                    switch(true) {
                        default:

                            return call_user_func_array($this->arg($config->service()), $this->args($config->args()));

                            break;
                        case is_array($config->service()):

                            return call_user_func_array($this->args($config->service()), $this->args($config->args()));

                            break;
                    }
                };

                break;
        }
    }
}
