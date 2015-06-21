<?php
/**
 *
 */

namespace Mvc5\Route\Exception;

use Mvc5\Route\Route;

interface RouteException
    extends Route
{
    /**
     *
     */
    const EXCEPTION = 'exception';

    /**
     *
     */
    const ROUTE = 'route';

    /**
     * @return \Exception
     */
    function exception();

    /**
     * @return Route
     */
    function route();
}
