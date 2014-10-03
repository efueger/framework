<?php

namespace Framework\Controller\Dispatch;

use Framework\Event\EventInterface as Event;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const DISPATCH = 'Dispatch\Event';

    /**
     *
     */
    const REQUEST = 'Request';

    /**
     *
     */
    const RESPONSE = 'Response';

    /**
     * @return callable|string
     */
    function controller();

    /**
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    function signal(callable $listener, array $options = []);
}
