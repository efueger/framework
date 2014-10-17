<?php

namespace Framework\Response;

class Listener
    implements ListenerInterface
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
