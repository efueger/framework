<?php

namespace Framework\Mvc\Route;

use Framework\Route\Route\RouteInterface as Route;

interface DispatcherInterface
{
    /**
     * @param Route $route
     * @return Route|mixed
     */
    function __invoke(Route $route);
}
