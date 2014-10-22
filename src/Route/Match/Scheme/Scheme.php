<?php

namespace Framework\Route\Match\Scheme;

use Framework\Route\Definition\RouteDefinition;
use Framework\Route\Route;

class Scheme
    implements MatchScheme
{
    /**
     * @param Route $route
     * @param RouteDefinition $definition
     * @return Route
     */
    public function __invoke(Route $route, RouteDefinition $definition)
    {
        return !$definition->scheme() || in_array($route->scheme(), (array) $definition->scheme()) ? $route : null;
    }
}
