<?php

namespace Framework\Route\Dispatch;

use Framework\Event\EventInterface as Event;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const DISPATCH = 'Route\Dispatch\Event';
}
