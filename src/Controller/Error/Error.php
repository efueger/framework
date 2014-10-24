<?php

namespace Framework\Controller\Error;

use Framework\Response\Response;

interface Error
{
    /**
     * @param Response $response
     * @return ErrorModel
     */
    function __invoke(Response $response);
}
