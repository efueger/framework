<?php

namespace Framework\Response\Manager;

use Framework\Response\Response;

interface ResponseManager
{
    /**
     * @param Response $response
     * @return mixed
     */
    function send(Response $response);
}
