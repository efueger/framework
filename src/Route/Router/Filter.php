<?php

namespace Framework\Route\Router;

use Framework\Route\Route;

class Filter
    implements RouterFilter
{
    /**
     * @param Route $route
     */
    public function __invoke(Route $route)
    {
        $route->set(Route::PATH, urldecode(rtrim($route->path(), '/')) ?: '/');
    }
}
