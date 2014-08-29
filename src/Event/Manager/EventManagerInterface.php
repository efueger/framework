<?php

namespace Framework\Event\Manager;

use Framework\Event\EventInterface;

interface EventManagerInterface
{
    /**
     * @param array|EventInterface|string $event
     * @param null $options
     * @param callable $callback
     * @return mixed
     */
    public function trigger($event, $options = null, callable $callback = null);
}
