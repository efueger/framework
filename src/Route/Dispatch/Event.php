<?php

namespace Framework\Route\Dispatch;

use Framework\Event\EventTrait as EventTrait;
use Framework\Route\Route\RouteInterface as Route;

class Event
    implements EventInterface
{
    /**
     *
     */
    use EventTrait;

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
     * @return Route $route
     */
    public function route()
    {
        return $this->route;
    }

    /**
     * @param callable $listener
     * @param null $options
     * @return mixed
     */
    public function __invoke(callable $listener, $options = null)
    {
        $result = $listener($this, $options);

        if ($result && $result instanceof Route) {
            $this->stop();
        }

        return $result;
    }
}
