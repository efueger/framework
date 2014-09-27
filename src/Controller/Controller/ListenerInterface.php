<?php

namespace Framework\Controller\Controller;

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
    public function __invoke(EventInterface $event, Request $request, Response $response);
}
