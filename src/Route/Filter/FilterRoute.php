<?php
/**
 *
 */

namespace Framework\Route\Filter;

use Framework\Route\Route;

interface FilterRoute
{
    /**
     * @param Route $route
     */
    function __invoke(Route $route);
}
