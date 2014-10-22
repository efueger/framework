<?php

namespace Framework\Controller\Manager;

use Exception;

trait ServiceTrait
{
    /**
     * @var ControllerManager
     */
    protected $cm;

    /**
     * @param callable $controller
     * @param array $args
     * @return mixed
     */
    public function action(callable $controller, array $args = [])
    {
        return $this->cm->action($controller, $args);
    }

    /**
     * @param callable|string $controller
     * @return callable|null|object
     */
    public function controller($controller)
    {
        return $this->cm->controller($controller);
    }

    /**
     * @return ControllerManager
     */
    public function controllerManager()
    {
        return $this->cm;
    }

    /**
     * @param Exception $exception
     * @param array $args
     * @return mixed
     */
    public function exception(Exception $exception, array $args = [])
    {
        return $this->cm->exception($exception, $args);
    }

    /**
     * @param callable $controller
     * @param array $args
     * @return mixed
     */
    public function dispatch(callable $controller, array $args = [])
    {
        return $this->cm->dispatch($controller, $args);
    }

    /**
     * @param ControllerManager $cm
     */
    public function setControllerManager(ControllerManager $cm)
    {
        $this->cm = $cm;
    }
}