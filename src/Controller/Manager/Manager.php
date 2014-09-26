<?php

namespace Framework\Controller\Manager;

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
     * @param Route $route
     * @param null $options
     * @return mixed
     */
    public function dispatch(Route $route, $options = null)
    {
        return is_callable($route->controller())
                    ? $this->call($route->controller(), $route->params())
                        : $this->trigger([$route->controller(), $route], $options);
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
