<?php
/**
 *
 */

namespace Mvc5\Route\Exception\Manager;

use Mvc5\Route\Route;
use Mvc5\View\Model\ViewModel;

interface ExceptionManager
{
    /**
     * @param Route $route
     * @param \Exception $exception
     * @return ViewModel
     */
    function exception(Route $route, \Exception $exception);
}
