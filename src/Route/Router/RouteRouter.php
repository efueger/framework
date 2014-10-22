<?php

namespace Framework\Route\Router;

use Framework\Route\Definition\RouteDefinition;
use Framework\Route\Route;

interface RouteRouter
{
    /**
     * @param Route $route
     * @param RouteDefinition $definition
     * @return Route|null
     */
    function __invoke(Route $route, RouteDefinition $definition = null);
}
