<?php

namespace Framework\Route\Dispatch;

use Framework\Route\Route\RouteInterface as Route;

class Filter
    implements FilterInterface
{
    /**
     * @param Route $route
     * @param callable $plugins
     */
    public function __invoke(Route $route, callable $plugins)
    {
        $route->set(Route::PATH, urldecode(rtrim($route->path(), '/')) ?: '/');
    }
}
