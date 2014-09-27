<?php

namespace Framework\Controller\Exception;

use Exception;
use Framework\Event\EventInterface as Event;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const EXCEPTION = 'Controller\Exception\Event';

    /**
     * @return Exception
     */
    public function exception();
}
