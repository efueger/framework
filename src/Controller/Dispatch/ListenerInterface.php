<?php

namespace Framework\Controller\Dispatch;

interface ListenerInterface
{
    /**
     * @param $controller
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function __invoke($controller, array $args = [], callable $callback = null);
}
