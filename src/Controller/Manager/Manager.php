<?php

namespace Framework\Controller\Manager;

use Framework\Controller\Dispatch\EventInterface as Dispatch;
use Framework\Controller\Exception\EventInterface as Exception;
use Framework\Event\Manager\EventManagerInterface as EventManagerInterface;
use Framework\Event\Manager\EventsTrait as Events;
use Framework\Event\Signal\SignalTrait as Signal;
use Framework\Service\Manager\ManagerInterface as ServiceManagerInterface;

class Manager
    implements EventManagerInterface, ManagerInterface, ServiceManagerInterface
{
    /**
     *
     */
    use Events;
    use Signal;

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    public function action(callable $listener, array $args = [])
    {
        return $this->signal($listener, $args);
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
     * @param array $options
     * @return mixed
     */
    public function dispatch(callable $controller, array $options = [])
    {
        return $this->trigger([Dispatch::DISPATCH, $controller], $options);
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
