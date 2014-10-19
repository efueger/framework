<?php

namespace Framework\Mvc\View;

use Exception;
use Framework\View\Model\ModelInterface as View;
use Framework\View\Manager\ServiceTrait as ViewManager;

class Renderer
    implements RendererInterface
{
    /**
     *
     */
    use ViewManager;

    /**
     * @param View $viewModel
     * @return mixed
     */
    public function __invoke(View $viewModel = null)
    {
        if (!$viewModel) {
            return null;
        }

        try {

            return $this->render($viewModel);

        } catch(Exception $exception) {

            return $this->exception($exception);

        }
    }
}
