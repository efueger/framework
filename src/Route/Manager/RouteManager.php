<?php

namespace Framework\Route\Manager;

use Framework\Route\Definition\Definition;
use Framework\Route\Route;

interface RouteManager
{
    /**
     * @param Definition $definition
     * @return Definition
     */
    public function definition($definition);

    /**
     * @param Definition $definition
     * @param Route $route
     * @return Route
     */
    function match(Definition $definition, Route $route);

    /**
     * @param Route $route
     * @param array $args
     * @return Route
     */
    function route(Route $route, array $args = []);
}
