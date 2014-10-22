<?php

namespace Framework\Route\Match\Hostname;

use Framework\Route\Definition\RouteDefinition as Definition;
use Framework\Route\Route;

interface MatchHostname
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    function __invoke(Route $route, Definition $definition);
}
