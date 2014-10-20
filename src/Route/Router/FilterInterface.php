<?php

namespace Framework\Route\Router;

use Framework\Route\RouteInterface as Route;

interface FilterInterface
{
    /**
     * @param Route $route
     */
    function __invoke(Route $route);
}
