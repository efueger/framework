<?php
/**
 *
 */

namespace Framework\Mvc\Route;

use Framework\Route\Manager\ManageRoute;
use Framework\Route\Route;

class Router
    implements Dispatch
{
    /**
     *
     */
    use ManageRoute;

    /**
     * @param Route $route
     * @return Route
     */
    public function __invoke(Route $route)
    {
        return $this->route($route);
    }
}
