<?php

namespace Framework\Controller\Dispatch;

interface EventInterface
{
    /**
     *
     */
    const DISPATCH = 'Dispatch\Event';

    /**
     *
     */
    const REQUEST = 'Request';

    /**
     *
     */
    const RESPONSE = 'Response';

    /**
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke(callable $listener, array $args = [], callable $callback = null);
}
