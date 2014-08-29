<?php

namespace Framework\Route\Dispatch;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Manager\ServiceTrait as RouteManager;
use Framework\Route\Route\RouteInterface as Route;

class Dispatch
    implements DispatchInterface
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
    public function dispatch(Route $route, Definition $definition = null)
    {
        $definition = $definition ?: $this->definition;

        $route = $this->match($definition, clone $route);

        if (!$route || $route->matched()) {
            return $route;
        }

        foreach($definition->children() as $definition) {
            $match = $this->dispatch($route, $definition);

            if ($match) {
                return $match;
            }
        }

        return null;
    }

    /**
     * @param EventInterface $event
     * @param null $options
     * @return Route
     */
    public function __invoke(EventInterface $event, $options = null)
    {
        return $this->dispatch($event->route());
    }
}
