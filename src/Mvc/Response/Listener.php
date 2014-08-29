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
     * @param null $options
     * @return mixed
     */
    public function __invoke(EventInterface $event, $options = null)
    {
        return $this->response($event->response());
    }
}
