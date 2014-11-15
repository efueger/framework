<?php

namespace Framework\Controller\Exception;

use Exception as ExceptionInterface;
use Framework\Response\Response;
use Framework\View\Exception\ExceptionModel;
use Framework\View\Model\Service\ViewModel;

class Controller
    implements Exception
{
    /**
     *
     */
    use ViewModel;

    /**
     * @param ExceptionInterface $exception
     * @param Response $response
     * @return mixed
     */
    public function __invoke(ExceptionInterface $exception, Response $response)
    {
        $response->setStatus(500);

        return $this->model([ExceptionModel::EXCEPTION => $exception]);
    }
}
