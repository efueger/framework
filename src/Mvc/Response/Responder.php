<?php

namespace Framework\Mvc\Response;

use Framework\Response\ResponseInterface as Response;
use Framework\Response\Manager\ServiceTrait as ResponseManager;

class Responder
    implements ResponderInterface
{
    /**
     *
     */
    use ResponseManager;

    /**
     * @param Response $response
     * @return mixed
     */
    public function __invoke(Response $response)
    {
        return $this->response($response);
    }
}
