<?php

namespace Framework\Route\Match\Hostname;

use Framework\Route\Definition\RouteDefinition;
use Framework\Route\Route;

interface MatchHostname
{
    /**
     * @param Route $route
     * @param RouteDefinition $definition
     * @return Route
     */
    function __invoke(Route $route, RouteDefinition $definition);
}
