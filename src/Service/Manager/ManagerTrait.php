<?php

namespace Framework\Service\Manager;

use Closure;
use Framework\Service\Container\ServiceTrait as Container;
use Framework\Service\Resolver\ResolverInterface;
use Framework\Service\Resolver\ResolverTrait as Resolver;
use RuntimeException;

trait ManagerTrait
{
    /**
     *
     */
    use Container;
    use Resolver;

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
        if (is_string($config)) {

            if ($assigned = $this->assigned($config)) {
                return $this->create($assigned, $args);
            }

            if ($configured = $this->configured($config)) {
                return $this->create($configured, $args);
            }

            return $this->newInstanceArgs($config, $args);
        }

        if (is_array($config)) {
            return $this->create(array_shift($config), $config);
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
        if ($config instanceof Closure) {
            return $config::bind($config, $this);
        }

        if (is_string($config) && '@' === $config[0]) {
            $closure = function () use ($config) {
                $args = func_get_args();

                if ($args && is_array($args[0]) && isset($args[0][ResolverInterface::ARGS])) {
                    $args = $args[0][ResolverInterface::ARGS];
                }

                return $this->call(substr($config, 1), $args);
            };

            return $closure;
        }

        if (is_array($config) && is_string($config[0])) {
            return $config;
        }

        return $this->create($config);
    }
}
