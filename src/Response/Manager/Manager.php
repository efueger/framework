<?php

namespace Framework\Response\Manager;

use Framework\Event\Manager\EventManagerInterface as EventManagerInterface;
use Framework\Event\Manager\EventsTrait as Events;
use Framework\Response\SendInterface as Response;
use Framework\Response\ResponseInterface;
use Framework\Service\Manager\ManagerInterface as ServiceManagerInterface;

class Manager
    implements ManagerInterface, EventManagerInterface, ServiceManagerInterface
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
        return $this->trigger([Response::SEND, $response], [], $this);
    }
}
