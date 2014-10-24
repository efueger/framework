<?php

namespace Framework\Response;

interface Send
{
    /**
     * @param Response $response
     * @return mixed
     */
    function __invoke(Response $response);
}
