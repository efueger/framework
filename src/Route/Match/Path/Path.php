<?php
/**
 *
 */

namespace Framework\Route\Match\Path;

use Framework\Route\Definition\Definition;
use Framework\Route\Route;

class Path
    implements MatchPath
{
    /**
     * @param array $paramMap
     * @param array $matches
     * @return array
     */
    protected function params(array $paramMap, array $matches)
    {
        $matched = [];

        foreach($paramMap as $name => $param) {
            !empty($matches[$name]) && $matched[$param] = $matches[$name];
        }

        return $matched;
    }

    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    public function __invoke(Route $route, Definition $definition)
    {
        if (!preg_match('(\G' . $definition->regex() . ')', $route->path(), $matches, null, $route->length())) {
            return null;
        }

        $route->set(Route::CONTROLLER, $definition->controller());
        $route->set(Route::LENGTH,     $route->length() + strlen($matches[0]));
        $route->set(Route::MATCHED,    $route->length() == strlen($route->path()));
        $route->set(Route::PARAMS,     $this->params($definition->paramMap(), $matches) + $definition->defaults() + $route->params());

        return $route;
    }
}
