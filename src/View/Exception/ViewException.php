<?php

namespace Framework\View\Exception;

interface ViewException
{
    /**
     *
     */
    const VIEW = 'Exception\View';

    /**
     * @param callable $callable
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $callable, array $args = []);
}
