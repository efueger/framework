<?php

namespace Framework\Event\Manager;

use Framework\Event\EventInterface;

interface EventManagerInterface
{
    /**
     * @param array|EventInterface|string $event
     * @param array $options
     * @param callable $callback
     * @return mixed
     */
    function trigger($event, array $options = [], callable $callback = null);
}
