<?php

namespace Framework\Controller\Error;

use Framework\Response\Response;

interface ErrorController
{
    /**
     * @param Response $response
     * @return ErrorViewModel
     */
    function __invoke(Response $response);
}
