<?php

namespace Framework\Controller\Exception;

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
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
