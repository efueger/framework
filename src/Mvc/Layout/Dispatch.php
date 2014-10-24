<?php

namespace Framework\Mvc\Layout;

use Framework\View\Model\ViewModel;

interface Dispatch
{
    /**
     * @param ViewModel $viewModel
     * @return ViewModel
     */
    function __invoke(ViewModel $viewModel = null);
}
