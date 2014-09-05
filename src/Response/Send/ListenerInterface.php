<?php

namespace Framework\Response\Send;

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
