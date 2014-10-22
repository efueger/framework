<?php

namespace Framework\Route\Router;

use Framework\Route\Definition\RouteDefinition;
use Framework\Route\Manager\ServiceTrait as RouteManager;
use Framework\Route\Route;

class Router
    implements RouteRouter
{
    /**
     *
     */
    use RouteManager;

    /**
     * @var RouteDefinition
     */
    protected $definition;

    /**
     * @param RouteDefinition $definition
     */
    public function __construct(RouteDefinition $definition)
    {
        $this->definition = $definition;
    }

    /**
     * @param Route $route
     * @param RouteDefinition $definition
     * @return Route|null
     */
    public function __invoke(Route $route, RouteDefinition $definition = null)
    {
        $definition = $definition ?: $this->definition;

        $route = $this->match($definition, clone $route);

        if (!$route || $route->matched()) {
            return $route;
        }

        foreach($definition->children() as $definition) {
            if ($match = $this($route, $definition)) {
                return $match;
            }
        }

        return null;
    }
}
