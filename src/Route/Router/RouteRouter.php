<?php

namespace Framework\Route\Router;

use Framework\Route\Definition\RouteDefinition as Definition;
use Framework\Route\Route;

interface RouteRouter
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route|null
     */
    function __invoke(Route $route, Definition $definition = null);
}
