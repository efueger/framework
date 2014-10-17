<?php

namespace Framework\Response;

interface EventInterface
{
    /**
     *
     */
    const RESPONSE = 'Response\Event';

    /**
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke(callable $listener, array $args = [], callable $callback = null);
}
