<?php

namespace Framework\Route\Manager;

use Framework\Route\Definition\RouteDefinition;
use Framework\Route\Route;

interface RouteManager
{
    /**
     * @param RouteDefinition $definition
     * @param Route $route
     * @return Route
     */
    function match(RouteDefinition $definition, Route $route);

    /**
     * @param Route $route
     * @param array $args
     * @return Route
     */
    function route(Route $route, array $args = []);
}
