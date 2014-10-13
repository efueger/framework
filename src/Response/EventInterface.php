<?php

namespace Framework\Response;

use Framework\Event\EventInterface as Event;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const RESPONSE = 'Response\Event';

    /**
     * @return ResponseInterface
     */
    function response();
}
