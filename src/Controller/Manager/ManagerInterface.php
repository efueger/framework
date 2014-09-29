<?php

namespace Framework\Controller\Manager;

use Exception;
use Framework\Route\Route\RouteInterface as Route;

interface ManagerInterface
{
    /**
     * @param callable|string $controller
     * @return callable|null|object
     */
    public function controller($controller);

    /**
     * @param Route $route
     * @param array $options
     * @return mixed
     */
    public function dispatch(Route $route, array $options = []);

    /**
     * @param Exception $exception
     * @param array $options
     * @return mixed
     */
    public function exception(Exception $exception, array $options = []);
}
