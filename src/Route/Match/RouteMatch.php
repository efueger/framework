<?php

namespace Framework\Route\Match;

interface RouteMatch
{
    /**
     *
     */
    const ROUTE = 'Route\Match';

    /**
     * @param callable $callable
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $callable, array $args = []);
}
