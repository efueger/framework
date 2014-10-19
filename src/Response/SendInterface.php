<?php

namespace Framework\Response;

interface SendInterface
{
    /**
     *
     */
    const SEND = 'Response\Send';

    /**
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke(callable $listener, array $args = [], callable $callback = null);
}
