<?php

namespace Framework\Controller\Error;

use Framework\Response\ResponseInterface as Response;

interface ControllerInterface
{
    /**
     * @param Response $response
     * @return ViewModel
     */
    function __invoke(Response $response);
}
