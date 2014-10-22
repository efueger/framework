<?php

namespace Framework\Response\Manager;

use Framework\Event\Manager\EventManager;
use Framework\Event\Manager\Events;
use Framework\Response\ResponseDispatch as Dispatch;
use Framework\Response\Response;
use Framework\Service\Manager\ServiceManager;

class Manager
    implements EventManager, ServiceManager, ResponseManager
{
    /**
     *
     */
    use Events;

    /**
     * @param Response $response
     * @return mixed
     */
    public function send(Response $response)
    {
        return $this->trigger([Dispatch::RESPONSE, $response], [], $this);
    }
}
