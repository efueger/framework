<?php

namespace Framework\Controller\Manager;

use Framework\Controller\Action\ActionInterface as Controller;
use Framework\Controller\Exception\ActionInterface as Exception;
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
        return $this->trigger([Controller::ACTION, $controller], $args, $this);
    }

    /**
     * @param \Exception $exception
     * @param array $args
     * @return mixed
     */
    public function exception(\Exception $exception, array $args = [])
    {
        return $this->trigger([Exception::ACTION, $exception], $args, $this);
    }
}
