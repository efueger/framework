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
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
