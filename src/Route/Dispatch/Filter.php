<?php

namespace Framework\Route\Dispatch;

use Framework\Route\Route\RouteInterface as Route;

class Filter
    implements FilterInterface
{
    /**
     * @param EventInterface $event
     * @param array $options
     */
    public function __invoke(EventInterface $event, array $options = [])
    {
        $route = $event->route();

        $route->add(Route::PATH, urldecode(rtrim($route->path(), '/')) ?: '/');
    }
}
