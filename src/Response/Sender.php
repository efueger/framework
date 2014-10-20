<?php

namespace Framework\Response;

class Sender
    implements SenderInterface
{
    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function __invoke(ResponseInterface $response)
    {
        $response->send();
    }
}
