<?php

namespace Framework\View\Exception;

interface ViewException
{
    /**
     *
     */
    const VIEW = 'Exception\View';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
