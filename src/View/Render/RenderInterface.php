<?php

namespace Framework\View\Render;

use Framework\View\Model\ModelInterface as ViewModel;

interface RenderInterface
{
    /**
     * @param ViewModel $viewModel
     * @return mixed
     */
    function __invoke(ViewModel $viewModel);
}
