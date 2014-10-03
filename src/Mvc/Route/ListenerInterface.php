<?php

namespace Framework\Mvc\Route;

use Framework\Route\Route\RouteInterface as Route;
use Framework\Mvc\EventInterface;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param Route $route
     * @return mixed
     */
    function __invoke(EventInterface $event, Route $route);
}
