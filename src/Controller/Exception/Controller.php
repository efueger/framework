<?php

namespace Framework\Controller\Exception;

use Exception;
use Framework\Response\Response;
use Framework\View\Exception\ExceptionViewModel;
use Framework\View\Model\Service\ViewModel;

class Controller
    implements ExceptionController
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

        /** @var ExceptionViewModel $viewModel */
        $viewModel = $this->viewModel();

        $viewModel->setException($exception);

        return $viewModel;
    }
}
