<?php

namespace Framework\Mvc\Response;

use Framework\Response\ResponseInterface as Response;

interface ListenerInterface
{
    /**
     * @param Response $response
     * @return mixed
     */
    function __invoke(Response $response);
}
