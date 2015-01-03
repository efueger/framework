<?php
/**
 *
 */

namespace Framework\Route\Match\Method;

use Framework\Route\Definition\Definition;
use Framework\Route\Route;

interface MatchMethod
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    function __invoke(Route $route, Definition $definition);
}
