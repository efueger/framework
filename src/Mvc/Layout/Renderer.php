<?php

namespace Framework\Mvc\Layout;

use Framework\View\Layout\Layout;
use Framework\View\Model\ServiceTrait as ViewModelTrait;
use Framework\View\Model\ViewModel;

class Renderer
    implements LayoutRenderer
{
    /**
     *
     */
    use ViewModelTrait;

    /**
     * @param ViewModel $viewModel
     * @return ViewModel
     */
    public function __invoke(ViewModel $viewModel = null)
    {
        $layout = $this->viewModel();

        if (!$viewModel) {
            return null;
        }

        if ($viewModel instanceof Layout) {
            return $viewModel;
        }

        $layout->setContent($viewModel);

        return $layout;
    }
}
