<?php

namespace Framework\Mvc\Response;

use Framework\Response\ResponseInterface as Response;

interface ResponderInterface
{
    /**
     * @param Response $response
     * @return mixed
     */
    function __invoke(Response $response);
}
