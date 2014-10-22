<?php

namespace Framework\Response;

interface ResponseSender
{
    /**
     * @param Response $response
     * @return mixed
     */
    function __invoke(Response $response);
}
