<?php

namespace Framework\View\Exception;

use Exception;
use Framework\View\Manager\ManageView;

class Renderer
    implements Render
{
    /**
     *
     */
    use ManageView;

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
