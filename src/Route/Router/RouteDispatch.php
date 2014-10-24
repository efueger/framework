<?php

namespace Framework\Route\Router;

interface RouteDispatch
{
    /**
     *
     */
    const DISPATCH = 'Route\Dispatch';

    /**
     * @param callable $callable
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $callable, array $args = []);
}
