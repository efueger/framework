<?php

namespace Framework\Response\Manager;

use Framework\Response\ResponseInterface;

interface ManagerInterface
{
    /**
     * @param ResponseInterface $response
     * @param callable $callback
     * @return mixed
     */
    function response(ResponseInterface $response, callable $callback = null);
}
