<?php

namespace Framework\Service\Manager;

use RuntimeException;

trait Initializer
{
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
    protected abstract function create($config, array $args = [], callable $callback = null);

    /**
     * @param string $name
     * @param array $args
     * @param callable $callback
     * @return null|object|callable
     */
    protected function initialize($name, array $args = [], callable $callback = null)
    {
        return $this->initializing($name) ?: $this->initialized($name, $this->create($name, $args, $callback));
    }

    /**
     * @param string $name
     * @param $service
     * @return mixed
     */
    protected function initialized($name, $service = null)
    {
        $this->pending[$name] = false;

        $service && $this->set($name, $service);

        return $service;
    }

    /**
     * @param string $name
     * @return bool
     */
    protected function initializing($name)
    {
        if (!empty($this->pending[$name])) {
            throw new RuntimeException('Circular dependency: ' . $name);
        }

        $this->pending[$name] = true;

        return false;
    }

    /**
     * @param string $name
     * @param mixed $service
     * @return void
     */
    protected abstract function set($name, $service);
}
