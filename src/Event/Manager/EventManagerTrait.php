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
     * @return EventInterface|string
     */
    protected abstract function event($event);

    /**
     * @param Events $events
     */
    public function events(Events $events)
    {
        $this->events = $events;
    }

    /**
     * @param EventInterface|string $event
     * @param array $args
     * @param callable $callback
     * @return mixed|null
     */
    protected abstract function generate($event, array $args = [], callable $callback = null);

    /**
     * @return Events
     */
    protected function listeners()
    {
        return $this->events;
    }

    /**
     * @param array|EventInterface|string $event
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function trigger($event, array $args = [], callable $callback = null)
    {
        return $this->generate($this->event($event), $args, $callback);
    }
}
