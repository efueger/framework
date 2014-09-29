<?php

namespace Framework\Route\Dispatch;

use Framework\Route\Route\RouteInterface as Route;

class Filter
    implements FilterInterface
{
    /**
     * @param EventInterface $event
     * @param array $options
     * @return null
     */
    public function __invoke(EventInterface $event, array $options = [])
    {
        $route = $event->route();

        $route->add(Route::PATH, rtrim($route->path(), '/') ?: '/');

        return null;
    }
}
