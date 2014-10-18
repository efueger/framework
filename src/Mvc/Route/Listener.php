<?php

namespace Framework\Mvc\Route;

use Framework\Route\Route\RouteInterface as Route;
use Framework\Route\Manager\ServiceTrait as RouteManager;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use RouteManager;

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
     * @param callable $plugin
     * @return Route|mixed
     */
    public function __invoke(Route $route, callable $plugin = null)
    {
        return $this->dispatch($route, [], $plugin) ?: $this->route;
    }
}
