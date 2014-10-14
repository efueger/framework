<?php

namespace Framework\Response;

interface ListenerInterface
{
    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    function __invoke(ResponseInterface $response);
}
