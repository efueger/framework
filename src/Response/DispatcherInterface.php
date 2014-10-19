<?php

namespace Framework\Response;

interface DispatcherInterface
{
    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    function __invoke(ResponseInterface $response);
}
