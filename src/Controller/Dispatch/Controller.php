<?php

namespace Framework\Controller\Dispatch;

interface Controller
{
    /**
     *
     */
    const DISPATCH = 'Controller\Dispatch';

    /**
     *
     */
    const REQUEST = 'Request';

    /**
     *
     */
    const RESPONSE = 'Response';

    /**
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke(callable $callable, array $args = [], callable $callback = null);
}
