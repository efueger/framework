<?php

namespace Framework\Mvc\Route;

use Framework\Route\Route;
use Framework\Route\Manager\ManageRoute;

class Router
    implements RouteRouter
{
    /**
     *
     */
    use ManageRoute;

    /**
     * @var Route
     */
    protected $route;

    /**
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * @param Route $route
     * @return Route|mixed
     */
    public function __invoke(Route $route)
    {
        return $this->route($route) ?: $this->route;
    }
}
