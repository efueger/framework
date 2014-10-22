<?php

namespace Framework\Controller\Error;

use Framework\Response\Response;
use Framework\View\Model\Service\ViewModel;

class Controller
    implements ErrorController
{
    /**
     *
     */
    use ViewModel;

    /**
     * @param Response $response
     * @return ErrorViewModel
     */
    public function __invoke(Response $response)
    {
        $response->setStatus(404);

        return $this->viewModel();
    }
}
