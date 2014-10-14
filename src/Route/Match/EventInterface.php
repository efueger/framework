<?php

namespace Framework\Route\Match;

interface EventInterface
{
    /**
     *
     */
    const MATCH = 'Route\Match\Event';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
