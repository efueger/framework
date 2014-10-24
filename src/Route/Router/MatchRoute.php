<?php

namespace Framework\Route\Router;

use Framework\Route\Definition\Definition;
use Framework\Route\Route;

interface MatchRoute
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route|null
     */
    function __invoke(Route $route, Definition $definition = null);
}
