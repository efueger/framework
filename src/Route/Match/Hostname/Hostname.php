<?php

namespace Framework\Route\Match\Hostname;

use Framework\Route\Definition\Definition;
use Framework\Route\Route;

class Hostname
    implements MatchHostname
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    public function __invoke(Route $route, Definition $definition)
    {
        return !$definition->hostname() || in_array($route->hostname(), (array) $definition->hostname()) ? $route : null;
    }
}
