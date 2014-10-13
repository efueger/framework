<?php

namespace Framework\Response;

use Framework\Event\EventTrait as Base;

trait EventTrait
{
    /**
     *
     */
    use Base;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @return ResponseInterface
     */
    public function response()
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response)
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
