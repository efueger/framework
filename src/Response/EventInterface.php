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
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
