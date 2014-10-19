<?php

namespace Framework\Controller\Manager;

use Framework\Controller\Dispatch\DispatchInterface as Controller;
use Framework\Controller\Exception\DispatchInterface as Exception;
use Framework\Event\Manager\EventManagerInterface as EventManagerInterface;
use Framework\Event\Manager\EventsTrait as Events;
use Framework\Service\Manager\ManagerInterface as ServiceManagerInterface;

class Manager
    implements EventManagerInterface, ManagerInterface, ServiceManagerInterface
{
    /**
     *
     */
    use Events;

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    public function action(callable $listener, array $args = [])
    {
        return $this->signal($listener, $args, $this);
    }

    /**
     * @param callable|string $config
     * @return callable|null|object
     */
    public function controller($config)
    {
        return $this->invokable($config);
    }

    /**
     * @param callable $controller
     * @param array $args
     * @return mixed
     */
    public function dispatch(callable $controller, array $args = [])
    {
        return $this->trigger([Controller::DISPATCH, $controller], $args, $this);
    }

    /**
     * @param \Exception $exception
     * @param array $args
     * @return mixed
     */
    public function exception(\Exception $exception, array $args = [])
    {
        return $this->trigger([Exception::DISPATCH, $exception], $args, $this);
    }
}
