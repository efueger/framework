<?php

namespace Framework\Event\Manager;

use Framework\Event\Event;
use Framework\Event\Generator\EventGenerator;
use Framework\Service\Manager\ManageService;

trait Events
{
    /**
     *
     */
    use ManageEvent;
    use ManageService;
    use EventGenerator;

    /**
     * @param array|Event|string $event
     * @return Event
     */
    protected function event($event)
    {
        return $event instanceof Event ? $event : $this->create($event, [], function($event) { return $event; });
    }

    /**
     * @param array|callable|string $listener
     * @return callable
     */
    protected function listener($listener)
    {
        return $this->invokable($listener);
    }

    /**
     * @param callable|Event|string $event
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected function emit($event, callable $listener, array $args = [], callable $callback = null)
    {
        return is_callable($event) ? $event($listener, $args, $callback) : $this->invoke($listener, $args, $callback);
    }
}
