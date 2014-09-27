<?php

namespace Framework\Controller\Error;

use Framework\Response\ServiceTrait as Response;
use Framework\View\Model\ServiceTrait as ViewModel;

class Controller
    implements ControllerInterface
{
    /**
     *
     */
    use Response,
        ViewModel;

    /**
     * @return mixed
     */
    public function __invoke()
    {
        $this->response()->setStatus(404);

        return $this->viewModel();
    }
}
