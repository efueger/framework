<?php

namespace Framework\Route\Router;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Manager\ServiceTrait as RouteManager;
use Framework\Route\Route\RouteInterface as Route;

class Router
    implements RouterInterface
{
    /**
     *
     */
    use RouteManager;

    /**
     * @var Definition
     */
    protected $definition;

    /**
     * @param Definition $definition
     */
    public function __construct(Definition $definition)
    {
        $this->definition = $definition;
    }

    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route|null
     */
    public function __invoke(Route $route, Definition $definition = null)
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
