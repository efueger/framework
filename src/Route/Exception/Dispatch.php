<?php
/**
 *
 */

namespace Mvc5\Route\Exception;

interface Dispatch
{
    /**
     * @param RouteException $route
     * @return mixed
     */
    function __invoke(RouteException $route);
}
