<?php

namespace Framework\Mvc\Response;

use Framework\Response\Response;

interface Dispatch
{
    /**
     * @param Response $response
     * @return mixed
     */
    function __invoke(Response $response);
}
