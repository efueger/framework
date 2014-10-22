<?php

namespace Framework\Controller\Exception;

use Exception;
use Framework\Response\ResponseInterface as Response;

interface ExceptionController
{
    /**
     * @param Exception $exception
     * @param Response $response
     * @return mixed
     */
    function __invoke(Exception $exception, Response $response);
}
