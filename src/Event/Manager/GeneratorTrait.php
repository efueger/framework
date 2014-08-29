<?php

namespace Framework\Event\Manager;

use Framework\Event\Config\ConfigInterface;
use Framework\Event\EventInterface as Event;
use Generator;

trait GeneratorTrait
{
    /**
     * @return ConfigInterface
     */
    abstract protected function eventListeners();

    /**
     * @param Event $event
     * @param null $options
     * @param callable $callback
     * @return mixed|null
     */
    protected function generate(Event $event, $options = null, callable $callback = null)
    {
        $result = null;

        foreach($this->queue($event->event()) as $listener) {

            $result = $this->signal($event, $listener, $options);

            !$callback ?: $callback($event, $listener, $options, $result);

            if ($event->stopped()) {
                break;
            }
        }

        return $result;
    }

    /**
     * @param $listener
     * @return callable
     */
    abstract protected function listener($listener);

    /**
     * @param string $event
     * @return Generator
     */
    protected function queue($event)
    {
        foreach($this->eventListeners()->queue($event) as $listeners) {
            foreach($listeners as $listener) {
                yield $this->listener($listener);
            }
        }
    }

    /**
     * @param Event $event
     * @param callable $listener
     * @param null $options
     * @return mixed
     */
    abstract protected function signal(Event $event, callable $listener, $options = null);
}
