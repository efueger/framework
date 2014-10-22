<?php

namespace Framework\Mvc\Response;

use Framework\Response\Response;
use Framework\Response\Manager\ServiceTrait as ResponseManager;

class Dispatcher
    implements ResponseDispatcher
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
        return $this->send($response);
    }
}
