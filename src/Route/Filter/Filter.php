<?php

namespace Framework\Route\Filter;

use Framework\Route\Route;

class Filter
    implements FilterRoute
{
    /**
     * @param Route $route
     */
    public function __invoke(Route $route)
    {
        $route->set(Route::PATH, urldecode($route->path()) ?: '/');
    }
}
