<?php

namespace Framework\Response;

interface DispatchResponse
{
    /**
     *
     */
    const DISPATCH = 'Response\Dispatch';

    /**
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke(callable $listener, array $args = [], callable $callback = null);
}
