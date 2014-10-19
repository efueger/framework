<?php

namespace Framework\View\Exception;

use Exception;
use Framework\View\Manager\ServiceTrait as ViewManager;

class Renderer
    implements RendererInterface
{
    /**
     *
     */
    use ViewManager;

    /**
     * @param Exception $exception
     * @param ViewModelInterface $viewModel
     * @return mixed
     */
    public function __invoke(Exception $exception, ViewModelInterface $viewModel)
    {
        $viewModel->setException($exception);
        return $this->render($viewModel);
    }
}
