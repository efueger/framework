<?php

namespace Framework\Route\Match;

interface RouteMatch
{
    /**
     *
     */
    const ROUTE = 'Route\Match';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
