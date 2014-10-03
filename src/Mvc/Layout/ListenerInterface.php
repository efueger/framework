<?php

namespace Framework\Mvc\Layout;

use Framework\Mvc\EventInterface;
use Framework\View\Model\ModelInterface as ViewModel;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param ViewModel $viewModel
     * @return ViewModel
     */
    function __invoke(EventInterface $event, ViewModel $viewModel = null);
}
