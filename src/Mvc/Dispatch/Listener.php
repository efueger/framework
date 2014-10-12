<?php

namespace Framework\Mvc\Dispatch;

use Exception;
use Framework\Controller\Manager\ServiceTrait as ControllerManager;
use Framework\Mvc\EventInterface;
use Framework\Route\Route\RouteInterface as Route;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use ControllerManager;

    /**
     * @param EventInterface $event
     * @param Route $route
     * @return mixed
     */
    public function __invoke(EventInterface $event, Route $route)
    {
        try {

            return $this->dispatch($this->controller($route->controller()), [$event->args()]);

        } catch (Exception $exception) {

            return $this->exception($exception, [$event->args()]);

        }
    }
}
