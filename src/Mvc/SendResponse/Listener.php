<?php

namespace Framework\Mvc\SendResponse;

use Framework\Mvc\EventInterface;
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
     * @param null $options
     * @return mixed|void
     */
    public function __invoke(EventInterface $event, $options = null)
    {
        $this->send($event->response());
    }
}
