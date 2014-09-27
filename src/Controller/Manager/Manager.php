<?php

namespace Framework\Controller\Manager;

use Closure;
use Framework\Controller\Controller\EventInterface as Controller;
use Framework\Controller\Exception\EventInterface as Exception;
use Framework\Event\Manager\EventManagerInterface as EventManagerInterface;
use Framework\Event\Manager\EventsTrait as Events;
use Framework\Service\Manager\ManagerInterface as ServiceManagerInterface;
use Framework\Route\Route\RouteInterface as Route;

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
        if ($controller instanceof Closure) {
            return $this->factory($controller);
        }

        if (is_callable($controller)) {
            return $controller;
        }

        return $this->create($controller);
    }

    /**
     * @param Route $route
     * @param null $options
     * @return mixed
     */
    public function dispatch(Route $route, $options = null)
    {
        return $this->trigger([Controller::DISPATCH, $route], $options);
    }

    /**
     * @param \Exception $exception
     * @param null $options
     * @return mixed
     */
    public function exception(\Exception $exception, $options = null)
    {
        return $this->trigger([Exception::EXCEPTION, $exception], $options);
    }
}
