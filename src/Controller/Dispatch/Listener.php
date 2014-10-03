<?php

namespace Framework\Controller\Dispatch;

use Framework\Controller\Manager\ServiceTrait as ControllerManager;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use ControllerManager;

    /**
     * @param EventInterface $event
     * @param array $eventArgs
     * @return mixed
     */
    public function __invoke(EventInterface $event, array $eventArgs = [])
    {
        return $event->signal($this->controller($event->controller()), $eventArgs);
    }
}
