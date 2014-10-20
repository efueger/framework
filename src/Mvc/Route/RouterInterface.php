<?php

namespace Framework\Mvc\Route;

use Framework\Route\RouteInterface as Route;

interface RouterInterface
{
    /**
     * @param Route $route
     * @return Route|mixed
     */
    function __invoke(Route $route);
}
