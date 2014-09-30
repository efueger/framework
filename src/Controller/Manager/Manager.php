<?php

namespace Framework\Controller\Manager;

use Framework\Controller\Dispatch\EventInterface as Dispatch;
use Framework\Controller\Exception\EventInterface as Exception;
use Framework\Event\Manager\EventManagerInterface as EventManagerInterface;
use Framework\Event\Manager\EventsTrait as Events;
use Framework\Route\Route\RouteInterface as Route;
use Framework\Service\Manager\ManagerInterface as ServiceManagerInterface;

class Manager
    implements EventManagerInterface, ManagerInterface, ServiceManagerInterface
{
    /**
     *
     */
    use Events;

    /**
     * @param callable|string $controller
     * @return callable|null|object
     */
    public function controller($controller)
    {
        return $this->invokable($controller);
    }

    /**
     * @param Route $route
     * @param array $options
     * @return mixed
     */
    public function dispatch(Route $route, array $options = [])
    {
        return $this->trigger([Dispatch::DISPATCH, $route], $options);
    }

    /**
     * @param \Exception $exception
     * @param array $options
     * @return mixed
     */
    public function exception(\Exception $exception, array $options = [])
    {
        return $this->trigger([Exception::EXCEPTION, $exception], $options);
    }
}
