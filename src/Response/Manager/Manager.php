<?php

namespace Framework\Response\Manager;

use Framework\Event\Manager\EventManagerInterface as EventManagerInterface;
use Framework\Event\Manager\EventsTrait as Events;
use Framework\Response\Response\EventInterface as Response;
use Framework\Response\Send\EventInterface as Send;
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
    public function response(ResponseInterface $response)
    {
        return $this->trigger(Response::RESPONSE, $response);
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function send(ResponseInterface $response)
    {
        return $this->trigger(Send::SEND, $response);
    }
}
