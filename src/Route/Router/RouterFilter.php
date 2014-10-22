<?php

namespace Framework\Route\Router;

use Framework\Route\Route;

interface RouterFilter
{
    /**
     * @param Route $route
     */
    function __invoke(Route $route);
}
