<?php

namespace Framework\Route\Manager;

use Framework\Route\Definition\RouteDefinition;
use Framework\Route\Route;

trait ServiceTrait
{
    /**
     * @var RouteManager
     */
    protected $rm;

    /**
     * @param RouteDefinition $definition
     * @param Route $route
     * @return Route
     */
    public function match(RouteDefinition $definition, Route $route)
    {
        return $this->rm->match($definition, $route);
    }

    /**
     * @param Route $route
     * @param array $args
     * @return Route
     */
    public function route(Route $route, array $args = [])
    {
        return $this->rm->route($route, $args);
    }

    /**
     * @param  RouteManager $rm
     */
    public function setRouteManager(RouteManager $rm)
    {
        $this->rm = $rm;
    }
}
