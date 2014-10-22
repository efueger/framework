<?php

namespace Framework\Controller\Manager;

use Exception;
use Framework\Controller\Dispatch\ControllerDispatch;
use Framework\Controller\Exception\ExceptionDispatch;
use Framework\Event\Manager\EventManager;
use Framework\Event\Manager\Events;
use Framework\Service\Manager\ServiceManager;

class Manager
    implements EventManager, ControllerManager, ServiceManager
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
        return $this->signal($controller, $args, $this);
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
        return $this->trigger([ControllerDispatch::CONTROLLER, $controller], $args, $this);
    }

    /**
     * @param Exception $exception
     * @param array $args
     * @return mixed
     */
    public function exception(Exception $exception, array $args = [])
    {
        return $this->trigger([ExceptionDispatch::EXCEPTION, $exception], $args, $this);
    }
}
