<?php

namespace Framework\View\Render;

use Framework\Event\EventInterface as Event;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const RENDER = 'View\Render\Event';
}
