<?php

namespace Framework\View\Renderer;

use Framework\View\Model\ViewModel;

interface ViewRenderer
{
    /**
     * @param ViewModel $viewModel
     * @return mixed
     */
    function __invoke(ViewModel $viewModel);
}
