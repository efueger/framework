<?php

namespace Framework\Response;

class Dispatcher
    implements DispatcherInterface
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
