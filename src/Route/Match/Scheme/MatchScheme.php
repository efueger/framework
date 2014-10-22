<?php

namespace Framework\Route\Match\Scheme;

use Framework\Route\Definition\RouteDefinition as Definition;
use Framework\Route\Route;

interface MatchScheme
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    function __invoke(Route $route, Definition $definition);
}
