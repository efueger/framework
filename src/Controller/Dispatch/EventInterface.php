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
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
