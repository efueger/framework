<?php

namespace Framework\Event\Generator;

use Framework\Event\Config\ConfigInterface;
use Framework\Event\EventInterface as Event;
use Generator;

trait GeneratorTrait
{
    /**
     * @param Event $event
     * @param array $options
     * @param callable $callback
     * @return mixed|null
     */
    protected function generate(Event $event, array $options = [], callable $callback = null)
    {
        $result = null;

        foreach($this->queue($event->event()) as $listener) {

            $result = $this->signal($event, $listener, $options);

            $callback && $callback($event, $listener, $options, $result);

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
     * @return ConfigInterface
     */
    abstract protected function listeners();

    /**
     * @param string $event
     * @return Generator
     */
    protected function queue($event)
    {
        foreach($this->listeners()->queue($event) as $listeners) {
            foreach($listeners as $listener) {
                yield $this->listener($listener);
            }
        }
    }

    /**
     * @param Event $event
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    protected function signal(Event $event, callable $listener, array $options = [])
    {
        /** @var callable $event */
        return is_callable($event) ? $event($listener, $options) : $listener($event, $options);
    }
}
