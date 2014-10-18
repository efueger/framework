<?php

namespace Framework\Controller\Dispatch;

interface ListenerInterface
{
    /**
     * @param $controller
     * @param array $args
     * @return mixed
     */
    function __invoke($controller, array $args = []);
}
