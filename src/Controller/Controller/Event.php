<?php

namespace Framework\Controller\Controller;

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
        return $listener($this, $options[0], $options[1]); //[$request, $response]
    }
}
