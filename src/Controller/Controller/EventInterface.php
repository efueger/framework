<?php

namespace Framework\Controller\Controller;

use Framework\Event\EventInterface as Event;
use Framework\Route\Route\RouteInterface as Route;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const DISPATCH = 'Controller\Event';

    /**
     * @return Route
     */
    public function route();
}
