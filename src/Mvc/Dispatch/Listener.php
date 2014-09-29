<?php

namespace Framework\Mvc\Dispatch;

use Exception;
use Framework\Mvc\EventInterface;
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
        try {

            return $this->dispatch($event->route(), $event->args());

        } catch (Exception $exception) {

            return $this->exception($exception, $event->args());

        }
    }
}
