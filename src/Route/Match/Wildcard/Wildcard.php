<?php

namespace Framework\Route\Match\Wildcard;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Match\EventInterface;
use Framework\Route\Match\MatchInterface;
use Framework\Route\Route\RouteInterface as Route;

class Wildcard
    implements MatchInterface, WildcardInterface
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    public function match(Route $route, Definition $definition)
    {
        if (!$definition->wildcard()) {
            return $route;
        }

        $params = $route->params();

        $parts  = explode('/', trim(substr($route->path(), $route->length()), '/'));

        for($i = 0, $n = count($parts); $i < $n; $i += 2) {
            if (!isset($parts[$i + 1]) || isset($params[$parts[$i]])) {
                continue;
            }

            $params[$parts[$i]] = $parts[$i + 1];
        }

        $route->add(Route::PARAMS,  $params);
        $route->add(Route::MATCHED, true);

        return $route;
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
