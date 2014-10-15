<?php

namespace Framework\Event\Generator;

use Framework\Event\Config\ConfigInterface;
use Framework\Event\EventInterface as Event;
use Generator;

trait GeneratorTrait
{
    /**
     * @param Event|string $event
     * @param array $args
     * @param callable $callback
     * @return mixed|null
     */
    protected function generate($event, array $args = [], callable $callback = null)
    {
        $result = null;

        foreach($this->queue(is_string($event) ? $event : $event->event()) as $listener) {

            $result = $this->emit($event, $listener, $args);

            $callback && $callback($event, $listener, $args, $result);

            if ($event instanceof Event && $event->stopped()) {
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
     * @param Event|string $event
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    protected function emit($event, callable $listener, array $args = [])
    {
        /** @var callable $event */
        return $event instanceof Event && is_callable($event) ? $event($listener, $args) : $listener($event, $args);
    }
}
