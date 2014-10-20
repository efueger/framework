<?php

namespace Framework\Route\Router;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\RouteInterface as Route;

interface RouterInterface
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route|null
     */
    function __invoke(Route $route, Definition $definition = null);
}
