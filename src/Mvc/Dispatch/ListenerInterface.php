<?php

namespace Framework\Mvc\Dispatch;

use Framework\Mvc\EventInterface;
use Framework\Route\Route\RouteInterface as Route;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param Route $route
     * @return mixed
     */
    function __invoke(EventInterface $event, Route $route);
}
