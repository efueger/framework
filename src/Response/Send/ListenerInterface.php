<?php

namespace Framework\Response\Send;

use Framework\Response\ResponderInterface as Responder;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param Responder $responder
     * @return bool
     */
    public function __invoke(EventInterface $event, Responder $responder);
}
