<?php

namespace Framework\Event\Manager;

use Framework\Event\ArgsInterface as Args;
use Framework\Event\EventInterface as Event;
use Framework\Event\Generator\GeneratorTrait as EventGenerator;
use Framework\Event\Manager\EventManagerTrait as EventManager;
use Framework\Service\Manager\ManagerInterface;
use Framework\Service\Manager\ManagerTrait as ServiceManager;

trait EventsTrait
{
    /**
     *
     */
    use EventGenerator;
    use EventManager;
    use ServiceManager;

    /**
     * @param array|Event|string $event
     * @return Event
     */
    protected function event($event)
    {
        /** @var ManagerInterface $this */

        return $event instanceof Event ? $event : $this->create($event, [], function($name) { return $name; });
    }

    /**
     * @param array|callable|string $listener
     * @return callable
     */
    protected function listener($listener)
    {
        /** @var ManagerInterface|self $this */

        return is_callable($listener) ? $listener : $this->invokable($listener);
    }

    /**
     * @param Event|string $event
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    protected function signal($event, callable $listener, array $options = [])
    {
        /** @var callable $event */
        if ($event instanceof Event) {
            if (is_callable($event)) {
                return $event($listener, $options);
            }

            if (is_string(key($options))) {
                return $this->invoke($listener, [Args::EVENT => $event] + $options);
            }

            return $listener($event, $options);
        }

        return $this->invoke($listener, $options);
    }
}
