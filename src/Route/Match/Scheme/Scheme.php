<?php

namespace Framework\Route\Match\Scheme;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Match\MatchInterface;
use Framework\Route\Route\RouteInterface as Route;

class Scheme
    implements MatchInterface, SchemeInterface
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    public function match(Route $route, Definition $definition)
    {
        return !$definition->scheme() || in_array($route->scheme(), (array) $definition->scheme()) ? $route : null;
    }

    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    public function __invoke(Route $route, Definition $definition)
    {
        return $this->match($route, $definition);
    }
}
