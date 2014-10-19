<?php

namespace Framework\View\Exception;

use Exception;
use Framework\View\Manager\ServiceTrait as ViewManager;
use Framework\View\Model\ServiceTrait as ViewModelTrait;

class Renderer
    implements RendererInterface
{
    /**
     *
     */
    use ViewManager;
    use ViewModelTrait;

    /**
     * @param Exception $exception
     * @return mixed
     */
    public function __invoke(Exception $exception)
    {
        /** @var ViewModelInterface $viewModel */

        $viewModel = $this->viewModel();

        $viewModel->setException($exception);

        return $this->render($viewModel);
    }
}