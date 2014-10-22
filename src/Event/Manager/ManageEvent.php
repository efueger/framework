<?php

namespace Framework\Event\Manager;

use Framework\Event\Config\Configuration;
use Framework\Event\Event;

trait ManageEvent
{
    /**
     * @var Events
     */
    protected $events;

    /**
     * @param array|Event|string $event
     * @return Event|string
     */
    protected abstract function event($event);

    /**
     * @param Configuration $events
     */
    public function events(Configuration $events)
    {
        $this->events = $events;
    }

    /**
     * @param Event|string $event
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
     * @param array|Event|string $event
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function trigger($event, array $args = [], callable $callback = null)
    {
        return $this->generate($this->event($event), $args, $callback);
    }
}
