<?php

namespace Framework\View\Exception;

use Framework\Event\EventInterface as Event;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const EXCEPTION = 'View\Exception\Event';
}
