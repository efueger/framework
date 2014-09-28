<?php

namespace Framework\Controller\Dispatch;

use Framework\Event\EventInterface as Event;
use Framework\Route\Route\RouteInterface as Route;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const DISPATCH = 'Dispatch\Event';

    /**
     * @return callable|string
     */
    public function controller();

    /**
     * @return array
     */
    public function params();

    /**
     * @return Route
     */
    public function route();
}
