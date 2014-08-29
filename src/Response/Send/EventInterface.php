<?php

namespace Framework\Response\Send;

use Framework\Event\EventInterface as Event;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const SEND = 'Response\Send\Event';
}
