<?php

namespace Framework\Route\Router;

use Framework\Route\Route;

class Filter
    implements FilterRoute
{
    /**
     * @var bool
     */
    protected $trim = true;

    /**
     * @param bool $trim
     */
    public function __construct($trim = true)
    {
        $this->trim = (bool) $trim;
    }

    /**
     * @param Route $route
     */
    public function __invoke(Route $route)
    {
        $route->set(Route::PATH, urldecode($this->trim ? rtrim($route->path(), '/') : $route->path()) ?: '/');
    }
}
