<?php

namespace Framework\Web\Layout;

use Framework\View\Model\ModelInterface as ViewModel;

interface ListenerInterface
{
    /**
     * @param ViewModel $viewModel
     * @return ViewModel
     */
    function __invoke(ViewModel $viewModel = null);
}
