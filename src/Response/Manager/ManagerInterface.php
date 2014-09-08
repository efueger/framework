<?php

namespace Framework\Response\Manager;

use Framework\Response\ResponseInterface;

interface ManagerInterface
{
    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function response(ResponseInterface $response);
}
