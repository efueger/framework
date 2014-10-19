<?php

namespace Framework\View\Exception;

interface RenderInterface
{
    /**
     *
     */
    const RENDER = 'Exception\Render';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
