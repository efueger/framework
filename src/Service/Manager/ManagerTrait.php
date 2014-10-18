<?php

namespace Framework\Service\Manager;

use Framework\Service\Container\ServiceTrait as Container;
use Framework\Service\Resolver\ResolverTrait as Resolver;
use Framework\Service\AliasTrait as Alias;
use RuntimeException;

trait ManagerTrait
{
    /**
     *
     */
    use Alias;
    use Container;
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
                return $this->create($assigned, $args);
            }

            if ($configured = $this->configured($config)) {
                return $this->create($configured, $args);
            }

            if ($callback && !class_exists($config)) {
                return $callback($config, $args);
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

    /**
     * @param $name
     * @param callable $callback
     * @return callable|null|object
     */
    public function plugin($name, callable $callback = null)
    {
        /** @var callable|self $this */
        return $this->get($this->alias($name) ?: $name, [], $callback ?: $this);
    }

    /**
     * @param string $plugin
     * @param callable $callback
     * @return mixed
     */
    public function __invoke($plugin, callable $callback = null)
    {
        return $this->plugin($plugin, $callback ?: function() {});
    }
}
