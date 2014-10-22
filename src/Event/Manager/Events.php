<?php

namespace Framework\Event\Manager;

use Framework\Event\Event;
use Framework\Event\Generator\EventGenerator;
use Framework\Service\Manager\ServiceManager;
use Framework\Service\Manager\ManageService;

trait Events
{
    /**
     *
     */
    use EventGenerator;
    use ManageEvent;
    use ManageService;

    /**
     * @param array|Event|string $event
     * @return Event
     */
    protected function event($event)
    {
        /** @var ServiceManager $this */

        return $event instanceof Event ? $event : $this->create($event, [], function($name) { return $name; });
    }

    /**
     * @param array|callable|string $listener
     * @return callable
     */
    protected function listener($listener)
    {
        /** @var ServiceManager|self $this */

        return is_callable($listener) ? $listener : $this->invokable($listener);
    }

    /**
     * @param Event|string $event
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected function emit($event, callable $listener, array $args = [], callable $callback = null)
    {
        /** @var callable $event */

        return is_callable($event) ? $event($listener, $args, $callback) : $this->invoke($listener, $args, $callback);
    }
}
