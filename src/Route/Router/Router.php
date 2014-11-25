<?php

namespace Framework\Route\Router;

use Framework\Route\Definition\Definition;
use Framework\Route\Manager\ManageRoute;
use Framework\Route\Route;

class Router
    implements MatchRoute
{
    /**
     *
     */
    use ManageRoute;

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
     * @return Definition[]
     */
    protected function children()
    {
        return $this->definition->children();
    }

    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route|null
     */
    protected function dispatch(Route $route, Definition $definition)
    {
        $route = $this->match($definition, clone $route);

        if (!$route || $route->matched()) {
            return $route;
        }

        foreach($definition->children() as $definition) {
            if ($match = $this->dispatch($route, $this->definition($definition))) {
                return $match;
            }
        }

        return null;
    }

    /**
     * @param Route $route
     * @return Route|null
     */
    public function __invoke(Route $route)
    {
        foreach($this->children() as $definition) {
            if ($match = $this->dispatch($route, $this->definition($definition))) {
                return $match;
            }
        }
    }
}
