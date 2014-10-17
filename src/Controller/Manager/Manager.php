<?php

namespace Framework\Controller\Manager;

use Framework\Controller\Dispatch\EventInterface as Dispatch;
use Framework\Controller\Exception\EventInterface as Exception;
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
     * @param callable $callback
     * @return mixed
     */
    public function action(callable $listener, array $args = [], callable $callback = null)
    {
        return $this->signal($listener, $args, $callback);
    }

    /**
     * @param callable|string $config
     * @param callable $callback
     * @return callable|null|object
     */
    public function controller($config, callable $callback = null)
    {
        return $this->invokable($config, $callback);
    }

    /**
     * @param callable $controller
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function dispatch(callable $controller, array $args = [], callable $callback = null)
    {
        return $this->trigger([Dispatch::DISPATCH, $controller], $args, $callback);
    }

    /**
     * @param \Exception $exception
     * @param array $args
     * @return mixed
     */
    public function exception(\Exception $exception, array $args = [])
    {
        return $this->trigger([Exception::EXCEPTION, $exception], $args);
    }
}
