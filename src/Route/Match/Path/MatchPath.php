<?php

namespace Framework\Route\Match\Path;

use Framework\Route\Definition\RouteDefinition;
use Framework\Route\Route;

interface MatchPath
{
    /**
     * @param Route $route
     * @param RouteDefinition $definition
     * @return Route
     */
    function __invoke(Route $route, RouteDefinition $definition);
}
