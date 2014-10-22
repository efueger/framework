<?php

namespace Framework\Mvc\Route;

use Framework\Route\Route;

interface RouteRouter
{
    /**
     * @param Route $route
     * @return Route|mixed
     */
    function __invoke(Route $route);
}
