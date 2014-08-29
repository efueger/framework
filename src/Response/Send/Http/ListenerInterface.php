<?php

namespace Framework\Response\Send\Http;

use Framework\Response\Send\EventInterface;
use Framework\Response\ResponseInterface as Response;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param Response $response
     * @return bool
     */
    public function __invoke(EventInterface $event, Response $response);
}
