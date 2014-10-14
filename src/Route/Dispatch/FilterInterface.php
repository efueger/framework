<?php

namespace Framework\Route\Dispatch;

use Framework\Route\Route\RouteInterface as Route;

interface FilterInterface
{
    /**
     * @param Route $route
     */
    function __invoke(Route $route);
}
