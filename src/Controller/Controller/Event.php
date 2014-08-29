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
     * @var Route
     */
    protected $route;

    /**
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->event  = $route->controller();
        $this->route  = $route;
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
