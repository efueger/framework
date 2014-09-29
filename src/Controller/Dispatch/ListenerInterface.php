<?php

namespace Framework\Controller\Dispatch;

use Framework\Request\RequestInterface as Request;
use Framework\Response\ResponseInterface as Response;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    function __invoke(EventInterface $event, Request $request, Response $response);
}
