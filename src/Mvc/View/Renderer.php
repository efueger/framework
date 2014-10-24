<?php

namespace Framework\Mvc\View;

use Exception;
use Framework\View\Model\ViewModel;
use Framework\View\Manager\ManageView;

class Renderer
    implements Render
{
    /**
     *
     */
    use ManageView;

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
