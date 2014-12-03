<?php

namespace Framework\Response\Send;

use Framework\Response\Response;

interface Send
{
    /**
     * @param Response $response
     * @return mixed
     */
    function __invoke(Response $response);
}
