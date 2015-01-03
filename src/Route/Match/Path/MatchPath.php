<?php
/**
 *
 */

namespace Framework\Route\Match\Path;

use Framework\Route\Definition\Definition;
use Framework\Route\Route;

interface MatchPath
{
    /**
     * @param Route $route
     * @param Definition $definition
     * @return Route
     */
    function __invoke(Route $route, Definition $definition);
}
