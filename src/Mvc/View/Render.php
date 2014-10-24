<?php

namespace Framework\Mvc\View;

use Framework\View\Model\ViewModel;

interface Render
{
    /**
     * @param ViewModel $viewModel
     * @return mixed
     */
    function __invoke(ViewModel $viewModel = null);
}
