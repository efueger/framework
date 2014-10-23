<?php

namespace Framework\Service\Manager;

use Closure;
use Framework\Service\Resolver\Resolver;
use RuntimeException;

trait ManageService
{
    /**
     *
     */
    use Resolver;

    /**
     * @var array
     */
    protected $pending = [];

    /**
     * @param array|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|null|object
     */
    public function create($config, array $args = [], callable $callback = null)
    {
        if (is_string($config)) {
            if ($assigned = $this->assigned($config)) {
                if ($assigned instanceof Closure) {
                    return $this->call($assigned, $args, $callback);
                }

                return $this->create($assigned, $args);
            }

            if ($configured = $this->configured($config)) {
                if ($configured instanceof Closure) {
                    return $this->call($configured, $args, $callback);
                }

                return $this->create($configured, $args);
            }

            if ($callback && !class_exists($config)) {
                return $callback($config);
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
     * @param callable $callback
     * @return null|object|callable
     */
    public function get($name, array $args = [], callable $callback = null)
    {
        if ($service = $this->service($name)) {
            return $service;
        }

        $this->initializing($name);

        $service = $this->create($name, $args, $callback);

        $this->initialized($name);

        $service && $this->set($name, $service);

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
}
