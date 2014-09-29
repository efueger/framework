<?php

namespace Framework\View\Render;

use Framework\Event\EventInterface as Event;
use Framework\View\Model\ModelInterface;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const RENDER = 'View\Render\Event';

    /**
     * @return ModelInterface
     */
    function viewModel();
}
