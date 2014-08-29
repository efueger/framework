<?php

namespace Framework\Route\Match;

use Framework\Event\EventInterface as Event;
use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

interface EventInterface
    extends Event
{
    /**
     *
     */
    const MATCH = 'Route\Match\Event';

    /**
     * @return Definition
     */
    public function definition();

    /**
     * @return Route
     */
    public function route();
}
