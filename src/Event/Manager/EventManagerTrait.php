<?php

namespace Framework\Event\Manager;

use Framework\Event\Config\ConfigInterface as Events;
use Framework\Event\EventInterface;

trait EventManagerTrait
{
    /**
     * @var Events
     */
    protected $events;

    /**
     * @param array|EventInterface|string $event
     * @return EventInterface
     */
    abstract protected function event($event);

    /**
     * @return Events
     */
    protected function eventListeners()
    {
        return $this->events;
    }

    /**
     * @param Events $events
     */
    public function events(Events $events)
    {
        $this->events = $events;
    }

    /**
     * @param EventInterface $event
     * @param null $options
     * @param callable $callback
     * @return mixed|null
     */
    abstract protected function generate(EventInterface $event, $options = null, callable $callback = null);

    /**
     * @param EventInterface $event
     * @param callable $listener
     * @param null $options
     * @return mixed
     */
    protected function signal(EventInterface $event, callable $listener, $options = null)
    {
        /** @var callable $event */
        return is_callable($event) ? $event($listener, $options) : $listener($event, $options);
    }

    /**
     * @param array|EventInterface|string $event
     * @param null $options
     * @param callable $callback
     * @return mixed
     */
    public function trigger($event, $options = null, callable $callback = null)
    {
        return $this->generate($this->event($event), $options, $callback);
    }
}
