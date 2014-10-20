<?php

namespace Framework\Route\Router;

use Framework\Route\Route\RouteInterface as Route;

class Filter
    implements FilterInterface
{
    /**
     * @param Route $route
     */
    public function __invoke(Route $route)
    {
        $route->set(Route::PATH, urldecode(rtrim($route->path(), '/')) ?: '/');
    }
}
