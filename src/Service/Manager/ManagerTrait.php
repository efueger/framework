<?php

namespace Framework\Service\Manager;

use Closure;
use Framework\Service\Container\ServiceTrait as Container;
use Framework\Service\Config\Call\CallInterface as Call;
use Framework\Service\Config\Child\ChildInterface as Child;
use Framework\Service\Config\ConfigInterface as Config;
use Framework\Service\Config\ConfigLink\ConfigLinkInterface as ConfigLink;
use Framework\Service\Config\Dependency\DependencyInterface as Dependency;
use Framework\Service\Config\Factory\FactoryInterface as Factory;
use Framework\Service\Config\Invoke\InvokeInterface as Invoke;
use Framework\Service\Config\ServiceManagerLink\ServiceManagerLinkInterface as ServiceManagerLink;
use Framework\Service\Resolver\ResolverTrait as Resolver;
use ReflectionClass;
use RuntimeException;

trait ManagerTrait
{
    /**
     *
     */
    use Container,
        Resolver;

    /**
     * @var array
     */
    protected $pending = [];

    /**
     * @param array|object|string $config
     * @param array $args
     * @return callable|null|object
     */
    public function create($config, array $args = [])
    {
        list($config, $args) = $this->options($config, $args);

        if (is_string($config)) {

            if ('@' === $config[0]) {
                return $this->call(substr($config, 1), $args);
            }

            if ('%' === $config[0]) {
                return $this->param(substr($config, 1), $args);
            }

            if ('#' === $config[0]) {
                return $this->get(substr($config, 1), $args);
            }

            if ('*' === $config[0]) {
                switch(substr($config, 1)) {
                    default:
                        break;
                    case 'Config':
                        return $this->config();
                        break;
                    case 'ServiceManager':
                        return $this;
                        break;
                }
            }

            if ($assigned = $this->assigned($config)) {
                return $this->create($assigned, $args);
            }

            if ($configured = $this->configured($config)) {
                return $this->create($configured, $args);
            }

            if (is_callable($config)) {
                return $this->invoke($config, $args);
            }

            return $this->newInstanceArgs($config, $args);
        }

        /** @var Config $config */

        if ($config instanceof Factory) {
            /** @var Child $config */
            return $this->invoke($this->child($config, $args));
        }

        if ($config instanceof Child) {
            /** @var Child $config */
            return $this->child($config, $args);
        }

        if ($config instanceof Dependency) {
            return $this->get($config->name());
        }

        if ($config instanceof Call) {
            return $this->call($config->config(), $config->args());
        }

        if ($config instanceof ConfigLink) {
            return $this->config();
        }

        if ($config instanceof ServiceManagerLink) {
            return $this;
        }

        if ($config instanceof Invoke) {
            return function() use ($config) {
                return $this->invoke($config->config(), $config->args());
            };
        }

        return $this->resolve($config, $args);
    }

    /**
     * @param string $name
     * @param array $args
     * @return null|object|callable
     */
    public function get($name, array $args = [])
    {
        if ($service = $this->service($name)) {
            return $service;
        }

        $this->initializing($name);

        $service = $this->create($name, $args);

        $this->initialized($name);

        $service && $this->add($name, $service);

        return $service;
    }

    /**
     * @param $name
     */
    protected function initialized($name)
    {
        $this->pending[$name] = false;
    }

    /**
     * @param $name
     */
    protected function initializing($name)
    {
        if (!empty($this->pending[$name])) {
            throw new RuntimeException('Circular dependency: ' . $name);
        }

        $this->pending[$name] = true;
    }

    /**
     * @param callable|string $config
     * @return callable|null
     */
    protected function invokable($config)
    {
        if (is_string($config) && '@' === $config[0]) {
            return function () use ($config) {
                return $this->call(substr($config, 1), func_get_args());
            };
        }

        if ($config instanceof Closure) {
            return $config::bind($config, $this);
        }

        if (is_callable($config)) {
            return $config;
        }

        return $this->create($config);
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
}
