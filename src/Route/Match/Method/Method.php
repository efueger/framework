<?php

namespace Framework\Route\Match\Method;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Match\EventInterface;
use Framework\Route\Match\MatchInterface;
use Framework\Route\Route\RouteInterface as Route;

class Method
    implements MatchInterface, MethodInterface
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    public function match(Route $route, Definition $definition)
    {
        return !$definition->method() || in_array($route->method(), (array) $definition->method()) ? $route : null;
    }

    /**
     * @param EventInterface $event
     * @param array $options
     * @return Route
     */
    public function __invoke(EventInterface $event, array $options = [])
    {
        return $this->match($event->route(), $event->definition());
    }
}
