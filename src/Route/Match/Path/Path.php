<?php

namespace Framework\Route\Match\Path;

use Framework\Route\Definition\Definition;
use Framework\Route\Route;

class Path
    implements MatchPath
{
    /**
     * @param array $paramMap
     * @param array $matches
     * @param array $constraints
     * @return array
     */
    protected function constraints(array $paramMap, array $matches, array $constraints)
    {
        $matched = [];

        foreach($constraints as $name => $constraint) {
            foreach($paramMap as $param => $key) {
                if ($key !== $name || !isset($matches[$param])) {
                    continue;
                }

                if (!preg_match('(\G' . $constraint . ')', $matches[$param])) {
                    return [];
                }

                $matched[$param] = $matches[$param];
            }
        }

        return $matched;
    }

    /**
     * @param array $paramMap
     * @param array $matches
     * @return array
     */
    protected function params(array $paramMap, array $matches)
    {
        $params = [];

        foreach($paramMap as $name => $param) {
            !empty($matches[$name]) && $params[$param] = $matches[$name];
        }

        return $params;
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

        $params = $this->constraints($definition->paramMap(), $matches, $definition->constraints());

        if ($definition->constraints() && !$params) {
            return null;
        }

        $route->set(Route::CONTROLLER, $definition->controller());
        $route->set(Route::LENGTH,     $route->length() + strlen($matches[0]));
        $route->set(Route::MATCHED,    $route->length() == strlen($route->path()));
        $route->set(Route::NAME,       (!$route->name() ? '' :  $route->name() . '/') . $definition->name());
        $route->set(Route::PARAMS,     $params + $this->params($definition->paramMap(), $matches) + $definition->defaults() + $route->params());

        return $route;
    }
}
