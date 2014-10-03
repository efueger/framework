<?php

namespace Framework\Mvc\Render;

use Framework\Mvc\EventInterface;
use Framework\View\Model\ModelInterface as View;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param View $viewModel
     * @return mixed
     */
    function __invoke(EventInterface $event, View $viewModel = null);
}
