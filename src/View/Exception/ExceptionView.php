<?php

namespace Framework\View\Exception;

interface ExceptionView
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
