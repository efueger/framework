<?php

namespace Framework\Response\Exception;

use Framework\Response\Response;

class Dispatcher
    implements Dispatch
{
    /**
     * @var Response $response
     */
    protected $response;

    /**
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        return $this->response;
    }
}
