<?php

namespace Framework\Route\Manager;

use Framework\Event\Manager\EventManager;
use Framework\Event\Manager\Events;
use Framework\Route\Create\RouteCreator;
use Framework\Route\Definition\Definition;
use Framework\Route\Router\RouteDispatch;
use Framework\Route\Match\RouteMatch;
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
     * @return Definition
     */
    public function definition($definition)
    {
        return $definition instanceof Definition ? $definition
                    : $this->call('route:create', [Args::DEFINITION => $definition]);
    }

    /**
     * @param Definition $definition
     * @param Route $route
     * @return Route
     */
    public function match(Definition $definition, Route $route)
    {
        return $this->trigger([RouteMatch::ROUTE, $definition, $route], [], $this);
    }

    /**
     * @param Route $route
     * @param array $args
     * @return Route
     */
    public function route(Route $route, array $args = [])
    {
        return $this->trigger([RouteDispatch::DISPATCH, $route], $args, $this);
    }
}
