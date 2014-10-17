<?php

namespace Framework\View\Render;

use Framework\View\Model\ModelInterface as ViewModel;

interface RenderInterface
{
    /**
     * @param ViewModel $viewModel
     * @param callable $callback
     * @return mixed
     */
    function __invoke(ViewModel $viewModel, callable $callback = null);
}
