<?php

namespace Framework\Route\Match;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

interface MatchInterface
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    function match(Route $route, Definition $definition);
}
