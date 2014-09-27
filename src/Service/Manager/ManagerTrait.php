<?php

namespace Framework\Service\Manager;

use RuntimeException;
use Framework\Service\Container\ServiceTrait as Container;
use Framework\Service\Factory\FactoryInterface;
use Framework\Service\Config\FactoryInterface as FactoryConfig;

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
     * @param array|callable|FactoryInterface|object|FactoryConfig|string $factory
     * @param null $args
     * @return mixed
     */
    protected function call($factory, $args = null)
    {
        return call_user_func_array($this->factory($factory), (array) $args);
    }

    /**
     * @param array|FactoryConfig|string $name
     * @param null $args
     * @return null|object|callable
     */
    public function create($name, $args = null)
    {
        return $name instanceof FactoryConfig ? $this->call($name, $args) : $this->get($name, $args, false);
    }

    /**
     * @param array|callable|FactoryInterface|object|FactoryConfig|string $factory
     * @return callable|FactoryInterface
     */
    abstract protected function factory($factory);

    /**
     * @param $name
     * @param null $args
     * @param bool $shared
     * @return null|object|callable
     */
    public function get($name, $args = null, $shared = true)
    {
        list($name, $args) = $this->options($name, $args);

        if ($shared && $service = $this->service($name)) {
            return $service;
        }

        $service = $this->initialize($name, $this->assigned($name) ? : $this->configured($name) ? : $name, $args);

        if ($shared && $service) {
            $this->add($name, $service);
        }

        return $service;
    }

    /**
     * @param string $name
     * @param array|callable|FactoryInterface|object|FactoryConfig|string $factory
     * @param null $args
     * @return mixed
     * @throws RuntimeException
     */
    protected function initialize($name, $factory, $args = null)
    {
        if ($this->initializing($name)) {
            throw new RuntimeException('Circular dependency: ' . $name);
        }

        $service = $this->call($factory, $args);

        $this->initialized($name);

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
            return true;
        }

        $this->pending[$name] = true;

        return false;
    }

    /**
     * @param array|string $name
     * @param null $args
     * @return array
     */
    protected function options($name, $args = null)
    {
        if (is_array($name)) {
            return [array_shift($name), $name];
        }

        if (null === $args) {
            return [$name, []];
        }

        return [$name, is_array($args) ? $args : [$args]];
    }
}
