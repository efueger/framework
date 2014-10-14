<?php

namespace Framework\View\Render;

interface EventInterface
{
    /**
     *
     */
    const RENDER = 'View\Render\Event';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
