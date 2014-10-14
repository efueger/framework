<?php

namespace Framework\View\Exception;

interface EventInterface
{
    /**
     *
     */
    const EXCEPTION = 'View\Exception\Event';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
