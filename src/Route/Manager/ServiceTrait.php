<?php

namespace Framework\Route\Manager;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

trait ServiceTrait
{
    /**
     * @var ManagerInterface
     */
    protected $rm;

    /**
     * @param Route $route
     * @param array $args
     * @param callable $callback
     * @return Route
     */
    public function dispatch(Route $route, array $args = [], callable $callback = null)
    {
        return $this->rm->dispatch($route, $args, $callback);
    }

    /**
     * @param Definition $definition
     * @param Route $route
     * @param callable $callback
     * @return Route
     */
    public function match(Definition $definition, Route $route, callable $callback = null)
    {
        return $this->rm->match($definition, $route, $callback);
    }

    /**
     * @param  ManagerInterface $rm
     */
    public function setRouteManager(ManagerInterface $rm)
    {
        $this->rm = $rm;
    }
}
