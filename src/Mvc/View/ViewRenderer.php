<?php

namespace Framework\Mvc\View;

use Framework\View\Model\ViewModel;

interface ViewRenderer
{
    /**
     * @param ViewModel $viewModel
     * @return mixed
     */
    function __invoke(ViewModel $viewModel = null);
}
