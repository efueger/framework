<?php

namespace Framework\Route\Manager;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

interface ManagerInterface
{
    /**
     * @param Route $route
     * @param array $args
     * @param callable $callback
     * @return Route
     */
    function dispatch(Route $route, array $args = [], callable $callback = null);

    /**
     * @param Definition $definition
     * @param Route $route
     * @param callable $callback
     * @return Route
     */
    function match(Definition $definition, Route $route, callable $callback = null);
}
