<?php

namespace Framework\View\Exception;

use Exception;
use Framework\Event\EventInterface as Event;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const EXCEPTION = 'View\Exception\Event';

    /**
     * @return Exception
     */
    function exception();
}
