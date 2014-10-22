<?php

namespace Framework\Route\Manager;

use Framework\Event\Manager\EventManager;
use Framework\Event\Manager\Events;
use Framework\Route\Definition\Definition;
use Framework\Route\Router\RouterDispatch as Router;
use Framework\Route\Match\RouteMatch as Match;
use Framework\Route\Route;
use Framework\Service\Manager\ServiceManager;

class Manager
    implements EventManager, RouteManager, ServiceManager
{
    /**
     *
     */
    use Events;

    /**
     * @param Definition $definition
     * @param Route $route
     * @return Route
     */
    public function match(Definition $definition, Route $route)
    {
        return $this->trigger([Match::ROUTE, $definition, $route], [], $this);
    }

    /**
     * @param Route $route
     * @param array $args
     * @return Route
     */
    public function route(Route $route, array $args = [])
    {
        return $this->trigger([Router::DISPATCH, $route], $args, $this);
    }
}
