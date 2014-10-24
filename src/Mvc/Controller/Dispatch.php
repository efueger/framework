<?php

namespace Framework\Mvc\Controller;

interface Dispatch
{
    /**
     * @param $controller
     * @param array $args
     * @return mixed
     */
    function __invoke($controller, array $args = []);
}
