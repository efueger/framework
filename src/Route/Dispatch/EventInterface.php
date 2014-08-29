<?php

namespace Framework\Route\Dispatch;

use Framework\Event\EventInterface as Event;
use Framework\Route\Route\RouteInterface as Route;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const DISPATCH = 'Route\Dispatch\Event';

    /**
     * @return Route $route
     */
    public function route();
}
