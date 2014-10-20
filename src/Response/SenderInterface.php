<?php

namespace Framework\Response;

interface SenderInterface
{
    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    function __invoke(ResponseInterface $response);
}
