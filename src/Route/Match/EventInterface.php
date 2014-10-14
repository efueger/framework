<?php

namespace Framework\Route\Match;

use Framework\Event\EventInterface as Event;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const MATCH = 'Route\Match\Event';
}
