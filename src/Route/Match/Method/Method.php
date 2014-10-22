<?php

namespace Framework\Route\Match\Method;

use Framework\Route\Definition\RouteDefinition;
use Framework\Route\Route;

class Method
    implements MatchMethod
{
    /**
     * @param Route $route
     * @param RouteDefinition $definition
     * @return Route
     */
    public function __invoke(Route $route, RouteDefinition $definition)
    {
        return !$definition->method() || in_array($route->method(), (array) $definition->method()) ? $route : null;
    }
}
