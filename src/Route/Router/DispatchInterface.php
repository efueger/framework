<?php

namespace Framework\Route\Router;

interface DispatchInterface
{
    /**
     *
     */
    const DISPATCH = 'Route\Dispatch';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
