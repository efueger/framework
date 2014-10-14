<?php

namespace Framework\Route\Match\Hostname;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Match\EventInterface;
use Framework\Route\Match\MatchInterface;
use Framework\Route\Route\RouteInterface as Route;

class Hostname
    implements HostnameInterface, MatchInterface
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    public function match(Route $route, Definition $definition)
    {
        return !$definition->hostname() || in_array($route->hostname(), (array) $definition->hostname()) ? $route : null;
    }

    /**
     * @param EventInterface $event
     * @param array $args
     * @return Route
     */
    public function __invoke(EventInterface $event, array $args = [])
    {
        return $this->match($event->route(), $event->definition());
    }
}
