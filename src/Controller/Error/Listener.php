<?php

namespace Framework\Controller\Error;

use Framework\View\Model\ServiceTrait as ViewModel;
use Framework\Request\RequestInterface as Request;
use Framework\Response\ResponseInterface as Response;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use ViewModel;

    /**
     * @param EventInterface $event
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function __invoke(EventInterface $event, Request $request, Response $response)
    {
        $response->setStatus(404);

        return $this->viewModel();
    }
}
