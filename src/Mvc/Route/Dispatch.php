<?php
/**
 *
 */

namespace Framework\Mvc\Route;

use Framework\Route\Route;

interface Dispatch
{
    /**
     * @param Route $route
     * @return Route
     */
    function __invoke(Route $route);
}
