<?php

namespace Framework\Route\Match\Method;

use Framework\Route\Definition\RouteDefinition;
use Framework\Route\Route;

interface MatchMethod
{
    /**
     * @param Route $route
     * @param RouteDefinition $definition
     * @return Route
     */
    function __invoke(Route $route, RouteDefinition $definition);
}
