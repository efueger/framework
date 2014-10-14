<?php

namespace Framework\View\Render;

use Framework\Event\EventInterface as Event;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const RENDER = 'View\Render\Event';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
