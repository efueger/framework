<?php

namespace Framework\Mvc\Response;

use Framework\Response\ResponseInterface as Response;
use Framework\Response\Manager\ServiceTrait as ResponseManager;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use ResponseManager;

    /**
     * @param Response $response
     * @param callable $plugin
     * @return mixed
     */
    public function __invoke(Response $response, callable $plugin = null)
    {
        return $this->response($response, $plugin);
    }
}
