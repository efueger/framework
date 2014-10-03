<?php

namespace Framework\Mvc\Response;

use Framework\Mvc\EventInterface;
use Framework\Response\ResponseInterface as Response;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param Response $response
     * @return mixed
     */
    function __invoke(EventInterface $event, Response $response);
}
