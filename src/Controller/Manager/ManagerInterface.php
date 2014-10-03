<?php

namespace Framework\Controller\Manager;

use Exception;

interface ManagerInterface
{
    /**
     * @param callable|string $config
     * @return callable|null|object
     */
    function controller($config);

    /**
     * @param callable $controller
     * @param array $options
     * @return mixed
     */
    function dispatch(callable $controller, array $options = []);

    /**
     * @param Exception $exception
     * @param array $options
     * @return mixed
     */
    function exception(Exception $exception, array $options = []);
}
