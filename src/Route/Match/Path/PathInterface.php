<?php

namespace Framework\Route\Match\Path;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

interface PathInterface
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    function __invoke(Route $route, Definition $definition);
}
