<?php

namespace Framework\Route\Match\Wildcard;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

class Wildcard
    implements WildcardInterface
{
   /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    public function __invoke(Route $route, Definition $definition)
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

        $route->set(Route::PARAMS,  $params);
        $route->set(Route::MATCHED, true);

        return $route;
    }
}
