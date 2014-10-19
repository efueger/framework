<?php

namespace Framework\Route\Dispatch;

interface DispatchInterface
{
    /**
     *
     */
    const ROUTE = 'Route\Dispatch';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
