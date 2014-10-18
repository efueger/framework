<?php

namespace Framework\Route\Manager;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

interface ManagerInterface
{
    /**
     * @param Route $route
     * @param array $args
     * @return Route
     */
    function dispatch(Route $route, array $args = []);

    /**
     * @param Definition $definition
     * @param Route $route
     * @return Route
     */
    function match(Definition $definition, Route $route);
}
