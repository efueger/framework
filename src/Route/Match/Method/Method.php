<?php

namespace Framework\Route\Match\Method;

use Framework\Route\Definition\Definition;
use Framework\Route\Route;

class Method
    implements MatchMethod
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    public function __invoke(Route $route, Definition $definition)
    {
        return !$definition->method() || in_array($route->method(), (array) $definition->method()) ? $route : null;
    }
}
