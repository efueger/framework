<?php

namespace Framework\Route\Manager;

use Framework\Event\Manager\EventManagerInterface as EventManagerInterface;
use Framework\Event\Manager\EventsTrait as Events;
use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Dispatch\EventInterface as Dispatch;
use Framework\Route\Match\EventInterface as Match;
use Framework\Route\Route\RouteInterface as Route;
use Framework\Service\Manager\ManagerInterface as ServiceManagerInterface;

class Manager
    implements EventManagerInterface, ManagerInterface, ServiceManagerInterface
{
    /**
     *
     */
    use Events;

    /**
     * @param Route $route
     * @return Route
     */
    public function dispatch(Route $route)
    {
       return $this->trigger([Dispatch::DISPATCH, $route]);
    }

    /**
     * @param Definition $definition
     * @param Route $route
     * @return Route
     */
    public function match(Definition $definition, Route $route)
    {
        return $this->trigger([Match::MATCH, $definition, $route]);
    }
}
