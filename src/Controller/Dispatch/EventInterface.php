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
     * @param array $options
     * @return array
     */
    function args(array $options = []);

    /**
     * @return callable|string
     */
    function controller();

    /**
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    function signal(callable $listener, array $options = []);

    /**
     * @return Route
     */
    function route();
}
