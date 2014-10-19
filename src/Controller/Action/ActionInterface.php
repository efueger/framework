<?php

namespace Framework\Controller\Action;

interface ActionInterface
{
    /**
     *
     */
    const CONTROLLER = 'Controller\Action';

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
