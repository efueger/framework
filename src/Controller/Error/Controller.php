<?php

namespace Framework\Controller\Error;

use Framework\Response\Response;
use Framework\View\Model\Service\ViewModel;

class Controller
    implements Error
{
    /**
     *
     */
    use ViewModel;

    /**
     * @param Response $response
     * @return ErrorModel
     */
    public function __invoke(Response $response)
    {
        $response->setStatus(404);

        return $this->model();
    }
}
