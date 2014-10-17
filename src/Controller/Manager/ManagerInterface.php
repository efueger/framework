<?php

namespace Framework\Controller\Manager;

use Exception;

interface ManagerInterface
{
    /**
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function action(callable $listener, array $args = [], callable $callback = null);

    /**
     * @param callable|string $config
     * @param callable $callback
     * @return callable|null|object
     */
    function controller($config, callable $callback = null);

    /**
     * @param callable $controller
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function dispatch(callable $controller, array $args = [], callable $callback = null);

    /**
     * @param Exception $exception
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function exception(Exception $exception, array $args = [], callable $callback = null);
}
