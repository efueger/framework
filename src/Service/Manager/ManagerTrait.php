<?php

namespace Framework\Service\Manager;

use RuntimeException;
use Framework\Service\Container\ServiceTrait as Container;
use Framework\Service\Provider\Provider;

trait ManagerTrait
{
    /**
     *
     */
    use Container;

    /**
     * @var array
     */
    protected $pending = [];

    /**
     * @param array|object|string $config
     * @param array $args
     * @return null|object|callable
     */
    public function create($config, array $args = [])
    {
        /** @var ManagerInterface $this */
        return (new Provider($this))->create($config, $args);
    }

    /**
     * @param string $name
     * @param array $args
     * @param bool $shared
     * @return null|object|callable
     */
    public function get($name, array $args = [], $shared = true)
    {
        if ($shared && $service = $this->service($name)) {
            return $service;
        }

        $shared && $this->initializing($name);

        $service = $this->create($name, $args);

        $shared && $this->initialized($name);

        $shared && $service && $this->add($name, $service);

        return $service;
    }

    /**
     * @param string $name
     * @return self
     */
    protected function initialized($name)
    {
        $this->pending[$name] = false;
    }

    /**
     * @param string $name
     * @return self
     */
    protected function initializing($name)
    {
        if (!empty($this->pending[$name])) {
            throw new RuntimeException('Circular dependency: ' . $name);
        }

        return $this->pending[$name] = true;
    }
}
