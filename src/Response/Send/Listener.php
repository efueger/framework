<?php

namespace Framework\Response\Send;

use Framework\Response\ResponderInterface as Responder;

class Listener
    implements ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param Responder $responder
     * @return bool
     */
    public function __invoke(EventInterface $event, Responder $responder)
    {
        $responder->send();

        $event->stop();
    }
}
