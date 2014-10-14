<?php

namespace Framework\Route\Match\Scheme;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

interface SchemeInterface
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    function __invoke(Route $route, Definition $definition);
}
