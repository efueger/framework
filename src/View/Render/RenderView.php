<?php

namespace Framework\View\Render;

interface RenderView
{
    /**
     *
     */
    const VIEW = 'View\Render';

    /**
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke(callable $listener, array $args = [], callable $callback = null);
}