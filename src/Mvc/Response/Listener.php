<?php

namespace Framework\Mvc\Response;

use Framework\Mvc\EventInterface;
use Framework\Response\ResponseInterface as Response;
use Framework\Response\Manager\ServiceTrait as ResponseManager;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use ResponseManager;

    /**
     * @param EventInterface $event
     * @param Response $response
     * @return mixed
     */
    public function __invoke(EventInterface $event, Response $response)
    {
        return $this->response($response, [$event->args()]);
    }
}
