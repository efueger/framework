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
     * @param $definition
     * @return Definition
     */
    protected function create($definition)
    {
        return $definition instanceof Definition && !empty($definition[Definition::REGEX])
            ? $definition : $this->definition($definition);
    }

    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route|null
     */
    protected function dispatch(Route $route, Definition $definition)
    {
        $route->set(Route::NAME, $route->name() ?: $definition->name());

        $route = $this->match($definition, $route);

        if (!$route || $route->matched()) {
            return $route;
        }

        foreach($definition->children() as $name => $definition) {

            $route->set(Route::NAME, $route->name() . '/' . $name);

            if ($match = $this->dispatch(clone $route, $this->create($definition))) {
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
        return $this->dispatch(clone $route, $this->create($this->definition));
    }
}
