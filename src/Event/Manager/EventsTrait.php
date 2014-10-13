<?php

namespace Framework\Event\Manager;

use Closure;
use Framework\Event\EventInterface as Event;
use Framework\Event\Generator\GeneratorTrait as EventGenerator;
use Framework\Event\Manager\EventManagerTrait as EventManager;
use Framework\Service\Resolver\ResolverInterface;
use Framework\Service\Manager\ManagerInterface;
use Framework\Service\Manager\ManagerTrait as ServiceManager;
use ReflectionMethod;

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
            return is_callable($event) ? $event($listener, $options) : $listener($event, $options);
        }

        if ($listener instanceof Closure
                && is_string(key($options))
                    && !(new ReflectionMethod($listener, ResolverInterface::INVOKE))->getParameters()) {
            return call_user_func_array($listener, [[ResolverInterface::ARGS => $options]]);
        }

        return $this->invoke($listener, $options);
    }
}
