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
     * @param callable $plugins
     * @return Route|null
     */
    public function __invoke(Route $route, Definition $definition = null, callable $plugins = null)
    {
        $definition = $definition ?: $this->definition;

        $route = $this->match($definition, clone $route, $plugins);

        if (!$route || $route->matched()) {
            return $route;
        }

        foreach($definition->children() as $definition) {
            $match = $this($route, $definition, $plugins);

            if ($match) {
                return $match;
            }
        }

        return null;
    }
}
