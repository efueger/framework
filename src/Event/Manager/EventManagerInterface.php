<?php

namespace Framework\Event\Manager;

use Framework\Event\EventInterface;

interface EventManagerInterface
{
    /**
     * @param array|EventInterface|string $event
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function trigger($event, array $args = [], callable $callback = null);
}
