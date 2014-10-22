<?php

namespace Framework\Mvc\Layout;

use Framework\View\Model\ViewModel;

interface LayoutRenderer
{
    /**
     * @param ViewModel $viewModel
     * @return ViewModel
     */
    function __invoke(ViewModel $viewModel = null);
}
