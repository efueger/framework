<?php

namespace Framework\Route\Dispatch;

use Framework\Route\Route\RouteInterface as Route;

interface FilterInterface
{
    /**
     * @param Route $route
     * @param callable $callback
     */
    function __invoke(Route $route, callable $callback);
}
