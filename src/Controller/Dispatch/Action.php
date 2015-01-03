<?php
/**
 *
 */

namespace Framework\Controller\Dispatch;

interface Action
{
    /**
     * @param callable $controller
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $controller, array $args = []);
}
