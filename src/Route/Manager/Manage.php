<?php

namespace Framework\Route\Manager;

use Framework\Route\Definition\Definition;
use Framework\Route\Router\RouteDispatch;
use Framework\Route\Match\RouteMatch;
use Framework\Route\Route;

trait Manage
{
    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public function definition($definition)
    {
        return $this->call(Args::CREATE, [Args::DEFINITION => $definition]);
    }

    /**
     * @param array|callable|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     */
    protected abstract function call($config, array $args = [], callable $callback = null);

    /**
     * @param Definition $definition
     * @param Route $route
     * @return Route
     */
    public function match(Definition $definition, Route $route)
    {
        return $this->trigger([RouteMatch::ROUTE, $definition, $route], [], $this);
    }

    /**
     * @param Route $route
     * @param array $args
     * @return Route
     */
    public function route(Route $route, array $args = [])
    {
        return $this->trigger([RouteDispatch::DISPATCH, $route], $args, $this);
    }

    /**
     * @param string $event
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected abstract function trigger($event, array $args = [], callable $callback = null);

    /**
     * @param string $name
     * @param callable $callback
     * @return mixed
     */
    public abstract function __invoke($name, callable $callback = null);
}
