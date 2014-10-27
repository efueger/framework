<?php

namespace Framework\Controller\Exception;

interface DispatchException
{
    /**
     *
     */
    const EXCEPTION = 'Controller\Exception';

    /**
     *
     */
    const REQUEST = 'request';

    /**
     *
     */
    const RESPONSE = 'response';

    /**
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke(callable $callable, array $args = [], callable $callback = null);
}
