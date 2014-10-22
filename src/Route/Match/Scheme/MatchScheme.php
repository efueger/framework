<?php

namespace Framework\Route\Match\Scheme;

use Framework\Route\Definition\RouteDefinition;
use Framework\Route\Route;

interface MatchScheme
{
    /**
     * @param Route $route
     * @param RouteDefinition $definition
     * @return Route
     */
    function __invoke(Route $route, RouteDefinition $definition);
}
