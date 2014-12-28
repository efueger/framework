<?php

namespace Framework\Event\Generator;

use Framework\Event\Config\Configuration;
use Framework\Event\Event;
use Generator;
use Traversable;

trait EventGenerator
{
    /**
     * @param callable|Event|string|Traversable $event
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected function emit($event, callable $listener, array $args = [], callable $callback = null)
    {
        return is_callable($event) ? $event($listener, $args, $callback) : $this->signal($listener, $args, $callback);
    }

    /**
     * @param Event|string|Traversable $event
     * @param array $args
     * @param callable $callback
     * @return mixed|null
     */
    protected function generate($event, array $args = [], callable $callback = null)
    {
        $result = null;

        foreach($this->queue($event) as $listener) {

            $result = $this->emit($event, $listener, $args, $callback);

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
    protected abstract function listener($listener);

    /**
     * @return Configuration
     */
    protected abstract function listeners();

    /**
     * @param Event|string|Traversable $event
     * @return Generator
     */
    protected function queue($event)
    {
        return $this->traverse(
            $event instanceof Traversable ? $event : $this->listeners()->queue(
                is_object($event) ? $event instanceof Event ? $event->event() : get_class($event)  : $event
            )
        );
    }

    /**
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected abstract function signal(callable $listener, array $args = [], callable $callback = null);

    /**
     * @param array|Traversable $iterator
     * @return Generator
     */
    protected function traverse($iterator)
    {
        foreach($iterator as $listeners) {
            foreach($listeners as $listener) {
                yield $this->listener($listener);
            }
        }
    }
}
