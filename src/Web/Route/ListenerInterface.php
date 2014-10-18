<?php

namespace Framework\Web\Route;

use Framework\Route\Route\RouteInterface as Route;

interface ListenerInterface
{
    /**
     * @param Route $route
     * @return Route|mixed
     */
    function __invoke(Route $route);
}
