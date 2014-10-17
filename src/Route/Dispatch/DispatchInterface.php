<?php

namespace Framework\Route\Dispatch;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

interface DispatchInterface
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @param callable $callback
     * @return Route|null
     */
    function __invoke(Route $route, Definition $definition = null, callable $callback = null);
}
