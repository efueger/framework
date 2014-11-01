<?php

namespace Framework\Service\Manager;

use Closure;
use Framework\Service\Container\Service;
use Framework\Service\Resolver\Args;
use Framework\Service\Resolver\Resolver;

trait ManageService
{
    /**
     *
     */
    use Alias;
    use Resolver;
    use Service;
    use Initializer;

    /**
     * @param array|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|null|object
     */
    public function create($config, array $args = [], callable $callback = null)
    {
        if (!is_string($config)) {
            return is_array($config) ? $this->create(array_shift($config), $config) : $this->resolve($config, $args);
        }

        if ($configured = $this->configured($config)) {
            return $configured instanceof Closure
                ? $this->call($configured->bindTo($this), $args) : $this->create($configured, $args);
        }

        return $callback && !class_exists($config) ? $callback($config) : $this->newInstanceArgs($config, $args);
    }

    /**
     * @param string $name
     * @param array $args
     * @param callable $callback
     * @return null|object|callable
     */
    public function get($name, array $args = [], callable $callback = null)
    {
        return $this->service($name) ?: $this->initialize($name, $args, $callback);
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
