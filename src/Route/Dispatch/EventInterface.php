<?php

namespace Framework\Route\Dispatch;

interface EventInterface
{
    /**
     *
     */
    const DISPATCH = 'Route\Dispatch\Event';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
