<?php

namespace Framework\Response\Manager;

use Framework\Event\Manager\EventManager;
use Framework\Event\Manager\Events;
use Framework\Response\DispatchInterface as Dispatch;
use Framework\Response\ResponseInterface;
use Framework\Service\Manager\ServiceManager;

class Manager
    implements ManagerInterface, EventManager, ServiceManager
{
    /**
     *
     */
    use Events;

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function send(ResponseInterface $response)
    {
        return $this->trigger([Dispatch::RESPONSE, $response], [], $this);
    }
}
