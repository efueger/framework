<?php

namespace Framework\Route\Manager;

use Framework\Route\Definition\Definition;
use Framework\Route\Route;

trait ManageRoute
{
    /**
     * @var RouteManager
     */
    protected $rm;

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public function definition($definition)
    {
        return $this->rm->definition($definition);
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
