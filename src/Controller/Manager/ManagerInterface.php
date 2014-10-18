<?php

namespace Framework\Controller\Manager;

use Exception;

interface ManagerInterface
{
    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function action(callable $listener, array $args = []);

    /**
     * @param callable|string $config
     * @return callable|null|object
     */
    function controller($config);

    /**
     * @param callable $controller
     * @param array $args
     * @return mixed
     */
    function dispatch(callable $controller, array $args = []);

    /**
     * @param Exception $exception
     * @param array $args
     * @return mixed
     */
    function exception(Exception $exception, array $args = []);
}
