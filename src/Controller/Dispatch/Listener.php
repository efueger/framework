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
     * @param array $options
     * @return mixed
     */
    public function __invoke(EventInterface $event, array $options = [])
    {
        return $event->signal($event->controller(), $options);
    }
}
