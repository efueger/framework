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
     * @return Route
     */
    public function dispatch(Route $route, array $args = [])
    {
        return $this->rm->dispatch($route, $args);
    }

    /**
     * @param Definition $definition
     * @param Route $route
     * @return Route
     */
    public function match(Definition $definition, Route $route)
    {
        return $this->rm->match($definition, $route);
    }

    /**
     * @param  ManagerInterface $rm
     */
    public function setRouteManager(ManagerInterface $rm)
    {
        $this->rm = $rm;
    }
}
