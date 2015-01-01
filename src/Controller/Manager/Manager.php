<?php

namespace Framework\Controller\Manager;

use Exception;
use Framework\Controller\Dispatch\Controller;
use Framework\Controller\Exception\DispatchException;
use Framework\Event\Manager\EventManager;
use Framework\Event\Manager\Events;
use Framework\Service\Manager\ServiceManager;

class Manager
    implements ControllerManager, EventManager, ServiceManager
{
    /**
     *
     */
    use Events;

    /**
     * @param callable $controller
     * @param array $args
     * @return mixed
     */
    public function action(callable $controller, array $args = [])
    {
        return $this->call($controller, $args, $this);
    }

    /**
     * @param array|callable|object|string $config
     * @return callable
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
     * @param Exception $exception
     * @param array $args
     * @return mixed
     */
    public function exception(Exception $exception, array $args = [])
    {
        return $this->trigger([DispatchException::EXCEPTION, $exception], $args, $this);
    }
}
