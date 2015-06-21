<?php
/**
 *
 */

namespace Mvc5\Route\Exception\Manager;

use Exception;
use Mvc5\Event\Manager\EventManager;
use Mvc5\Event\Manager\Events;
use Mvc5\Route\Exception\DispatchException;
use Mvc5\Route\Route;
use Mvc5\Service\Manager\ServiceManager;
use Mvc5\View\Model\ViewModel;

class Manager
    implements EventManager, ExceptionManager, ServiceManager
{
    /**
     *
     */
    use Events;

    /**
     * @param Route $route
     * @param \Exception $exception
     * @return ViewModel
     */
    public function exception(Route $route, \Exception $exception)
    {
        return $this->trigger([DispatchException::EXCEPTION, $route, $exception], [], $this);
    }
}
