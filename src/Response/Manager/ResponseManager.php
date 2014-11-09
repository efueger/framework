<?php

namespace Framework\Response\Manager;

use Exception;
use Framework\Response\Response;

interface ResponseManager
{
    /**
     * @param Exception $exception
     * @return mixed
     */
    function exception(Exception $exception);

    /**
     * @param Response $response
     * @return mixed
     */
    function send(Response $response);
}
