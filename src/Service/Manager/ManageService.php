<?php

namespace Framework\Service\Manager;

use Closure;
use Framework\Service\Container\Service;
use Framework\Service\Resolver\Args;
use Framework\Service\Resolver\Resolver;
use RuntimeException;

trait ManageService
{
    /**
     *
     */
    use Alias;
    use Resolver;
    use Service;

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
            if ($configured = $this->configured($config)) {
                return $configured instanceof Closure
                        ? $this->call($configured->bindTo($this), $args) : $this->create($configured, $args);
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

    /**
     * @param string $name
     * @param callable $callback
     * @return callable|null|object
     */
    public function plugin($name, callable $callback = null)
    {
        $alias = $this->alias($name);

        if ($alias && Args::CALL === $alias[0]) {
            $alias = substr($alias, 1);

            if (Args::CALL === $alias[0]) {
                return $this->call(substr($alias, 1));
            }

            return function(array $args = []) use ($alias) {
                return $this->call($alias, $args);
            };
        }

        return $this->get($alias ?: $name, [], $callback ?: function() {});
    }
}
