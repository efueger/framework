<?php

namespace Framework\Mvc\Layout;

use Framework\View\Layout\LayoutInterface as LayoutModel;
use Framework\View\Model\ServiceTrait as ViewModelTrait;
use Framework\View\Model\ModelInterface as ViewModel;

class Renderer
    implements RendererInterface
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

        if ($viewModel instanceof LayoutModel) {
            return $viewModel;
        }

        $layout->setContent($viewModel);

        return $layout;
    }
}
