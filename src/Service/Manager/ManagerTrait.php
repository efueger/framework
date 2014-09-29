<?php

namespace Framework\Service\Manager;

use Closure;
use Framework\Service\Container\ServiceTrait as Container;
use Framework\Service\Provider\Provider;
use RuntimeException;

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
     * @param $name
     */
    protected function initialized($name)
    {
        $this->pending[$name] = false;
    }

    /**
     * @param $name
     * @return bool
     */
    protected function initializing($name)
    {
        if (!empty($this->pending[$name])) {
            throw new RuntimeException('Circular dependency: ' . $name);
        }

        return $this->pending[$name] = true;
    }

    /**
     * @param callable|string $config
     * @return callable|null
     */
    protected function invokable($config)
    {
        if (is_string($config)) {
            if (false !== strpos($config, '.')) {
                return function () use ($config) {
                    return $this->create($config, func_get_args());
                };
            }

            if (is_callable($config)) {
                return $config;
            }
        }

        if ($config instanceof Closure) {
            return $config::bind($config, $this);
        }

        if (is_array($config) && is_callable($config)) {
            return $config;
        }

        return $this->create($config);
    }
}
