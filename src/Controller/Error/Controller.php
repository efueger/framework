<?php

namespace Framework\Controller\Error;

use Framework\Response\ResponseInterface as Response;
use Framework\View\Model\ServiceTrait as ViewModel;

class Controller
    implements ControllerInterface
{
    /**
     *
     */
    use ViewModel;

    /**
     * @param Response $response
     * @return ViewModel
     */
    public function __invoke(Response $response)
    {
        $response->setStatus(404);

        return $this->viewModel();
    }
}
