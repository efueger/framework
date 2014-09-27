<?php

namespace Framework\Controller\Controller;

use Framework\Request\RequestInterface as Request;
use Framework\Response\ResponseInterface as Response;
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
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function __invoke(EventInterface $event, Request $request, Response $response)
    {
        return call_user_func_array($this->controller($event->controller()), $event->route()->params());
    }
}
