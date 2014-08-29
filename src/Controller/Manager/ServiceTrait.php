<?php

namespace Framework\Controller\Manager;

use Exception;
use Framework\Route\Route\RouteInterface as Route;

trait ServiceTrait
{
    /**
     * @var ManagerInterface
     */
    protected $cm;

    /**
     * @return ManagerInterface
     */
    public function controllerManager()
    {
        return $this->cm;
    }

    /**
     * @param Exception $exception
     * @param null $options
     * @return mixed
     */
    public function exception(Exception $exception, $options = null)
    {
        return $this->cm->exception($exception, $options);
    }

    /**
     * @param Route $route
     * @param string $controller
     * @param null $options
     * @return mixed
     */
    public function dispatch(Route $route, $controller, $options = null)
    {
        return $this->cm->dispatch($route, $controller, $options);
    }

    /**
     * @param ManagerInterface $cm
     */
    public function setControllerManager(ManagerInterface $cm)
    {
        $this->cm = $cm;
    }
}