<?php

namespace Framework\Event\Manager;

use Framework\Event\EventInterface as Event;
use Framework\Event\Manager\EventManagerTrait as EventManager;
use Framework\Event\Manager\GeneratorTrait as EventGenerator;
use Framework\Service\Factory\FactoryTrait as Factory;
use Framework\Service\Manager\ManagerInterface;
use Framework\Service\Manager\ManagerTrait as ServiceManager;

trait EventsTrait
{
    /**
     *
     */
    use EventGenerator,
        EventManager,
        Factory,
        ServiceManager;

    /**
     * @param array|Event|string $event
     * @return Event
     */
    protected function event($event)
    {
        /** @var ManagerInterface $this */

        return $event instanceof Event ? $event : $this->create($event);
    }

    /**
     * @param array|callable|string $listener
     * @return callable
     */
    protected function listener($listener)
    {
        /** @var ManagerInterface $this */

        return is_callable($listener) ? $listener : $this->create($listener);
    }
}
