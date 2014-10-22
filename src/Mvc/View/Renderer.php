<?php

namespace Framework\Mvc\View;

use Exception;
use Framework\View\Model\ViewModel;
use Framework\View\Manager\ServiceTrait as ViewManager;

class Renderer
    implements ViewRenderer
{
    /**
     *
     */
    use ViewManager;

    /**
     * @param ViewModel $viewModel
     * @return mixed
     */
    public function __invoke(ViewModel $viewModel = null)
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
