<?php

namespace Framework\Route\Manager;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

interface ManagerInterface
{
    /**
     * @param Route $route
     * @return Route
     */
    public function dispatch(Route $route);

    /**
     * @param Definition $definition
     * @param Route $route
     * @return Route
     */
    public function match(Definition $definition, Route $route);
}
