<?php

namespace Framework\Mvc\Dispatch;

interface DispatcherInterface
{
    /**
     * @param $controller
     * @param array $args
     * @return mixed
     */
    function __invoke($controller, array $args = []);
}
