<?php

namespace Framework\Controller\Dispatch;

use Framework\Controller\Manager\ServiceTrait as ControllerManager;
use Framework\Request\RequestInterface as Request;
use Framework\Response\ResponseInterface as Response;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use ControllerManager;

    /**
     * @param EventInterface $event
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function __invoke(EventInterface $event, Request $request, Response $response)
    {
        return call_user_func_array($this->controller($event->controller()), $event->args());
    }
}
