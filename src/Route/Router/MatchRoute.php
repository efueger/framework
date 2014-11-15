<?php

namespace Framework\Route\Router;

use Framework\Route\Route;

interface MatchRoute
{
    /**
     * @param Route $route
     * @return Route|null
     */
    function __invoke(Route $route);
}
