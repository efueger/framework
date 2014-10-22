<?php

namespace Framework\Response;

trait ServiceTrait
{
    /**
     * @var Response
     */
    protected $response;

    /**
     * @return Response
     */
    public function response()
    {
        return $this->response;
    }

    /**
     * @param  Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }
}
