<?php

namespace Framework\Route\Match\Hostname;

use Framework\Route\Definition\RouteDefinition;
use Framework\Route\Route;

class Hostname
    implements MatchHostname
{
    /**
     * @param Route $route
     * @param RouteDefinition $definition
     * @return Route
     */
    public function __invoke(Route $route, RouteDefinition $definition)
    {
        return !$definition->hostname() || in_array($route->hostname(), (array) $definition->hostname()) ? $route : null;
    }
}
