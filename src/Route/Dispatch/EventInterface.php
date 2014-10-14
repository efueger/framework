<?php

namespace Framework\Route\Dispatch;

use Framework\Event\EventInterface as Event;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const DISPATCH = 'Route\Dispatch\Event';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
