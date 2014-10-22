<?php

namespace Framework\Route\Router;

interface RouterDispatch
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
