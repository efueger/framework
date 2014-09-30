<?php

namespace Framework\Controller\Exception;

use Framework\Request\RequestInterface as Request;
use Framework\Response\ResponseInterface as Response;
use Framework\View\Exception\ViewModelInterface;
use Framework\View\Model\ServiceTrait as ViewModel;

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
        $response->setStatus(500);

        /** @var ViewModelInterface $viewModel */
        $viewModel = $this->viewModel();

        $viewModel->setException($event->exception());

        return $viewModel;
    }
}
