<?php

namespace Framework\Controller\Exception;

use Exception;
use Framework\Response\ResponseInterface as Response;
use Framework\View\Exception\ViewModelInterface;
use Framework\View\Model\ServiceTrait as ViewModel;

class Dispatcher
    implements DispatcherInterface
{
    /**
     *
     */
    use ViewModel;

    /**
     * @param Exception $exception
     * @param Response $response
     * @return mixed
     */
    public function __invoke(Exception $exception, Response $response)
    {
        $response->setStatus(500);

        /** @var ViewModelInterface $viewModel */
        $viewModel = $this->viewModel();

        $viewModel->setException($exception);

        return $viewModel;
    }
}
