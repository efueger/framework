<?php

namespace Framework\Service\Manager;

use Closure;
use RuntimeException;
use Framework\Service\Config\Call\Call;
use Framework\Service\Config\ResolverInterface as Resolver;
use Framework\Service\Container\ServiceTrait as Container;
use Framework\Service\Factory\FactoryInterface;
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
     * @param array|Resolver|string $name
     * @param null $args
     * @return null|object|callable
     */
    public function create($name, $args = null)
    {
        return $name instanceof Resolver ? $this->invoke($name, $args) : $this->get($name, $args, false);
    }

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

        $config = $this->assigned($name) ? : $this->configured($name) ? : null;

        if (!$config) {
            return null;
        }

        $service = $this->initialize($name, $config, $args);

        if ($shared && $service) {
            $this->add($name, $service);
        }

        return $service;
    }

    /**
     * @param string $name
     * @param array|callable|Resolver|FactoryInterface|object|string $config
     * @param null $args
     * @return mixed
     * @throws RuntimeException
     */
    protected function initialize($name, $config, $args = null)
    {
        if ($this->initializing($name)) {
            throw new RuntimeException('Circular dependency: ' . $name);
        }

        $service = $this->invoke($config, $args);

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
     * @param callable|string $config
     * @return callable|null|object
     */
    protected function invokable($config)
    {
        if ($config instanceof Closure) {
            return $config::bind($config, $this);
        }

        if (is_callable($config)) {
            return $config;
        }

        if (is_string($config) && false !== strpos($config, '.')) {
            return function() use($config) {
                return $this->invoke(new Call($config, func_get_args()));
            };
        }

        return $this->create($config);
    }

    /**
     * @param Resolver|string $config
     * @param null $args
     * @return mixed
     */
    protected function invoke($config, $args = null)
    {
        /** @var ManagerInterface $this */
        return (new Provider($this))->__invoke($config, (array) $args);
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
