<?php

namespace Framework\Mvc\Response;

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
     * @param array $options
     * @return mixed
     */
    public function __invoke(EventInterface $event, array $options = [])
    {
        return $this->response($event->response());
    }
}
