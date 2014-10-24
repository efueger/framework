<?php

namespace Framework\Route\Router;

use Framework\Route\Route;

interface FilterRoute
{
    /**
     * @param Route $route
     */
    function __invoke(Route $route);
}
