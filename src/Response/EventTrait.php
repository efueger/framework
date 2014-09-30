<?php

namespace Framework\Response;

use Framework\Event\EventTrait as Base;
use Framework\Response\ResponseInterface as Response;

trait EventTrait
{
    /**
     *
     */
    use Base;

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
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @param $content
     */
    public function setResponseContent($content)
    {
        $this->response->setContent($content);
    }
}
