<?php
/**
 *
 */

namespace Mvc5\Route\Exception;

use Mvc5\Route\Route;

interface CreateException
{
    /**
     * @param Route $route
     * @param \Exception $exception
     * @return RouteException
     */
    function __invoke(Route $route, \Exception $exception);
}
