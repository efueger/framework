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
    const REQUEST = 'Request';

    /**
     *
     */
    const RESPONSE = 'Response';

    /**
     * @return Exception
     */
    public function exception();
}
