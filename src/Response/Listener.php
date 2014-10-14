<?php

namespace Framework\Response;

use Framework\View\Model\ServiceTrait as ViewModel;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use ViewModel;

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function __invoke(ResponseInterface $response)
    {
        return $response;
    }
}
