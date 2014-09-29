<?php

namespace Framework\Mvc\Route;

use Framework\Mvc\EventInterface;
use Framework\Route\Route\RouteInterface as Route;
use Framework\Route\Manager\ServiceTrait as RouteManager;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use RouteManager;

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
     * @param EventInterface $event
     * @param array $options
     * @return Route
     */
    public function __invoke(EventInterface $event, array $options = [])
    {
        return $this->dispatch($this->route);
    }
}
