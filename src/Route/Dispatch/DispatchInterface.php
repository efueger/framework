<?php

namespace Framework\Route\Dispatch;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

interface DispatchInterface
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route|null
     */
    function dispatch(Route $route, Definition $definition = null);
}
