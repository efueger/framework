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
     * @param callable|string $controller
     * @return callable|null|object
     */
    public function controller($controller)
    {
        return $this->cm->controller($controller);
    }

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
     * @param null $options
     * @return mixed
     */
    public function dispatch(Route $route, $options = null)
    {
        return $this->cm->dispatch($route, $options);
    }

    /**
     * @param ManagerInterface $cm
     */
    public function setControllerManager(ManagerInterface $cm)
    {
        $this->cm = $cm;
    }
}