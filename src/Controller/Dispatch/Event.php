<?php

namespace Framework\Controller\Dispatch;

use Framework\Event\EventTrait as EventTrait;
use Framework\Event\Signal\SignalTrait;
use Framework\Route\Route\RouteInterface as Route;

class Event
    implements EventInterface
{
    /**
     *
     */
    use EventTrait,
        SignalTrait;

    /**
     *
     */
    const EVENT = self::DISPATCH;

    /**
     * @var array
     */
    protected $args = [];

    /**
     * @var Route
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
     * @param array $options
     * @return array
     */
    public function args(array $options = [])
    {
        return ['event' => $this, 'eventArgs' => $options] + $options;
    }

    /**
     * @return callable|string
     */
    public function controller()
    {
        return $this->route->controller();
    }

    /**
     * @return Route
     */
    public function route()
    {
        return $this->route;
    }

    /**
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    public function __invoke(callable $listener, array $options = [])
    {
        return $this->signal($listener, $this->args($options));
    }
}
