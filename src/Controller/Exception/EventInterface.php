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
     *
     */
    const REQUEST = 'request';

    /**
     *
     */
    const RESPONSE = 'response';

    /**
     * @return Exception
     */
    function exception();
}
