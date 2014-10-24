<?php

namespace Framework\Response;

interface DispatchResponse
{
    /**
     *
     */
    const DISPATCH = 'Response\Dispatch';

    /**
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke(callable $callable, array $args = [], callable $callback = null);
}
