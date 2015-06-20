<?php
/**
 *
 */

namespace Mvc5\Route\Manager;

use Exception;
use Mvc5\Event\Manager\EventManager;
use Mvc5\Event\Manager\Events;
use Mvc5\Route\Definition\Definition;
use Mvc5\Route\Exception\RouteException;
use Mvc5\Route\Router\RouteDispatch;
use Mvc5\Route\Match\RouteMatch;
use Mvc5\Route\Route;
use Mvc5\Service\Manager\ServiceManager;

class Manager
    implements EventManager, RouteManager, ServiceManager
{
    /**
     *
     */
    use Events;

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public function definition($definition)
    {
        return $this->call(Args::CREATE, [$definition]);
    }

    /**
     * @param Route $route
     * @param Exception $exception
     * @return RouteException
     */
    public function exception(Route $route, Exception $exception)
    {
        return $this->call(Args::EXCEPTION, [$route, $exception]);
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
