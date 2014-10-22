<?php

namespace Framework\Route\Match\Wildcard;

use Framework\Route\Definition\RouteDefinition;
use Framework\Route\Route;

interface MatchWildcard
{
    /**
     * @param Route $route
     * @param RouteDefinition $definition
     * @return Route
     */
    function __invoke(Route $route, RouteDefinition $definition);
}
