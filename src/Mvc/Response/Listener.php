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
     * @param callable $plugins
     * @return mixed
     */
    public function __invoke(Response $response, callable $plugins = null)
    {
        return $this->response($response, $plugins);
    }
}
