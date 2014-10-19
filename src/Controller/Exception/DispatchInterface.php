<?php

namespace Framework\Controller\Exception;

interface DispatchInterface
{
    /**
     *
     */
    const DISPATCH = 'Exception\Dispatch';

    /**
     *
     */
    const REQUEST = 'request';

    /**
     *
     */
    const RESPONSE = 'response';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}
