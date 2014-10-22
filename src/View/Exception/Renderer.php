<?php

namespace Framework\View\Exception;

use Exception;
use Framework\View\Manager\ServiceTrait as ViewManager;

class Renderer
    implements ViewRenderer
{
    /**
     *
     */
    use ViewManager;

    /**
     * @param Exception $exception
     * @param ExceptionViewModel $viewModel
     * @return mixed
     */
    public function __invoke(Exception $exception, ExceptionViewModel $viewModel)
    {
        $viewModel->setException($exception);
        return $this->render($viewModel);
    }
}
