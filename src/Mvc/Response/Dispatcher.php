<?php

namespace Framework\Mvc\Response;

use Framework\Response\Response;
use Framework\Response\Manager\ManageResponse;

class Dispatcher
    implements ResponseDispatcher
{
    /**
     *
     */
    use ManageResponse;

    /**
     * @param Response $response
     * @return mixed
     */
    public function __invoke(Response $response)
    {
        return $this->send($response);
    }
}
