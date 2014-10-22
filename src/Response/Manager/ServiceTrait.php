<?php

namespace Framework\Response\Manager;

use Framework\Response\Response;

trait ServiceTrait
{
    /**
     * @var ResponseManager
     */
    protected $rm;

    /**
     * @param Response $response
     * @return mixed
     */
    public function send(Response $response)
    {
        return $this->rm->send($response);
    }

    /**
     * @param  ResponseManager $rm
     */
    public function setResponseManager(ResponseManager $rm)
    {
        $this->rm = $rm;
    }

    /**
     * @return ResponseManager
     */
    public function responseManager()
    {
        return $this->rm;
    }
}
