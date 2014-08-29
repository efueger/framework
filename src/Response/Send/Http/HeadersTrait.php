<?php

namespace Framework\Response\Send\Http;

use Framework\Response\ResponseInterface;

trait HeadersTrait
{
    /**
     * @param ResponseInterface $response
     * @return null
     */
    protected function sendHeaders(ResponseInterface $response)
    {
        if (headers_sent()) {
            return null;
        }

        foreach($response->headers() as $header) {
            header((string) $header);
        }

        header(sprintf('HTTP/%s %d %s', $response->version(), $response->status(), trim($response->reason())));
    }
}
