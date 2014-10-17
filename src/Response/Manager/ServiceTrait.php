<?php

namespace Framework\Response\Manager;

use Framework\Response\ResponseInterface;

trait ServiceTrait
{
    /**
     * @var ManagerInterface
     */
    protected $rm;

    /**
     * @param ResponseInterface $response
     * @param callable $callback
     * @return mixed
     */
    public function response(ResponseInterface $response, callable $callback = null)
    {
        return $this->rm->response($response, $callback);
    }

    /**
     * @param  ManagerInterface $rm
     */
    public function setResponseManager(ManagerInterface $rm)
    {
        $this->rm = $rm;
    }

    /**
     * @return ManagerInterface
     */
    public function responseManager()
    {
        return $this->rm;
    }
}
