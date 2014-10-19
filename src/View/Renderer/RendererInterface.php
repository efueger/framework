<?php

namespace Framework\View\Renderer;

use Framework\View\Model\ModelInterface as ViewModel;

interface RendererInterface
{
    /**
     * @param ViewModel $viewModel
     * @return mixed
     */
    function __invoke(ViewModel $viewModel);
}
