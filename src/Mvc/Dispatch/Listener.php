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
     * @param null $options
     * @return mixed
     */
    public function __invoke(EventInterface $event, $options = null)
    {
        try {

            return $this->dispatch($event->route(), [$event->request(), $event->response()]);

        } catch (Exception $exception) {

            return $this->exception($exception, [$event->request(), $event->response()]);

        }
    }
}
