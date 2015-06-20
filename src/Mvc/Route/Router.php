<?php
/**
 *
 */

namespace Mvc5\Mvc\Route;

use Exception;
use Mvc5\Route\Manager\ManageRoute;
use Mvc5\Route\Route;

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
        try {

            return $this->route($route);

        } catch(Exception $exception) {

            return $this->exception($route, $exception);

        }
    }
}
