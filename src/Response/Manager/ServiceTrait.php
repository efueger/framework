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
     * @return mixed
     */
    public function response(ResponseInterface $response)
    {
        return $this->rm->response($response);
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function send(ResponseInterface $response)
    {
        return $this->rm->send($response);
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
