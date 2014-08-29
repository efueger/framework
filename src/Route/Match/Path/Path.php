<?php

namespace Framework\Route\Match\Path;

use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Match\EventInterface;
use Framework\Route\Match\MatchInterface;
use Framework\Route\Route\RouteInterface as Route;

class Path
    implements MatchInterface, PathInterface
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    public function match(Route $route, Definition $definition)
    {
        if (!preg_match('(\G' . $definition->regex() . ')', $route->path(), $matches, null, $route->length())) {
            return null;
        }

        $route->add(Route::CONTROLLER, $definition->controller());
        $route->add(Route::LENGTH,     $route->length() + strlen($matches[0]));
        $route->add(Route::MATCHED,    $route->length() == strlen($route->path()));
        $route->add(Route::NAME,       (!$route->name() ? '' :  $route->name() . '/') . $definition->name());
        $route->add(Route::PARAMS,     $this->params($definition->paramMap(), $matches) + $definition->defaults() + $route->params());

        return $route;
    }

    /**
     * @param array $paramMap
     * @param array $matches
     * @return array
     */
    protected function params(array $paramMap, array $matches)
    {
        $matched = [];

        foreach($paramMap as $name => $param) {
            if (!empty($matches[$name])) {
                $matched[$param] = $matches[$name];
            }
        }

        return $matched;
    }

    /**
     * @param EventInterface $event
     * @param null $options
     * @return Route
     */
    public function __invoke(EventInterface $event, $options = null)
    {
        return $this->match($event->route(), $event->definition());
    }
}
