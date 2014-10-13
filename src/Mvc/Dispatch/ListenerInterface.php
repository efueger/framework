<?php

namespace Framework\Mvc\Dispatch;

interface ListenerInterface
{
    /**
     * @param $controller
     * @param array $__args__
     * @return mixed
     */
    function __invoke($controller, array $__args__ = []);
}
