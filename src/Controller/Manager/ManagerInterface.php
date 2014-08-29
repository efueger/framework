<?php

namespace Framework\Controller\Manager;

use Exception;
use Framework\Route\Route\RouteInterface as Route;

interface ManagerInterface
{
    /**
     * @param Route $route
     * @param null $options
     * @return mixed
     */
    public function dispatch(Route $route, $options = null);

    /**
     * @param Exception $exception
     * @param null $options
     * @return mixed
     */
    public function exception(Exception $exception, $options = null);
}
