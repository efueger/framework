<?php

namespace Framework\Route\Dispatch;

use Framework\Event\EventInterface as Base;
use Framework\Event\EventTrait;
use Framework\Service\Resolver\SignalTrait;
use Framework\Route\Route\RouteInterface as Route;

class Event
    implements Base, EventInterface
{
    /**
     *
     */
    use EventTrait;
    use SignalTrait;

    /**
     *
     */
    const EVENT = self::DISPATCH;

    /**
     * @var Route $route
     */
    protected $route;

    /**
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * @return array
     */
    protected function args()
    {
        return [
            ArgsInterface::EVENT => $this,
            ArgsInterface::ROUTE => $this->route
        ];
    }

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    public function __invoke(callable $listener, array $args = [])
    {
        $result = $this->signal($listener, $this->args() + $args);

        if ($result && $result instanceof Route) {
            $this->stop();
        }

        return $result;
    }
}
