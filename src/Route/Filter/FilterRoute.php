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
     * @return void
     */
    function __invoke(Route $route);
}
