<?php

namespace Framework\Route\Dispatch;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

interface DispatcherInterface
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route|null
     */
    function __invoke(Route $route, Definition $definition = null);
}
