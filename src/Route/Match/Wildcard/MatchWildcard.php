<?php

namespace Framework\Route\Match\Wildcard;

use Framework\Route\Definition\RouteDefinition as Definition;
use Framework\Route\Route;

interface MatchWildcard
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    function __invoke(Route $route, Definition $definition);
}
