<?php

namespace Framework\Controller\Error;

use Framework\Event\EventInterface as BaseEvent;
use Framework\Route\Route\RouteInterface;

interface EventInterface
    extends BaseEvent
{
    /**
     *
     */
    const ERROR = 'Controller\Error';

    /**
     * @return RouteInterface
     */
    public function route();
}
