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
     *
     */
    const REQUEST = 'Request';

    /**
     *
     */
    const RESPONSE = 'Response';

    /**
     * @return array
     */
    function args();

    /**
     * @return callable|string
     */
    function controller();

    /**
     * @return Route
     */
    function route();
}
