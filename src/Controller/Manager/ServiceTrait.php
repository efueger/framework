<?php

namespace Framework\Controller\Manager;

use Exception;

trait ServiceTrait
{
    /**
     * @var ManagerInterface
     */
    protected $cm;

    /**
     * @param $controller
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function action($controller, array $args = [], callable $callback = null)
    {
        return $this->cm->action($controller, $args, $callback);
    }

    /**
     * @param callable|string $controller
     * @param callable $callback
     * @return callable|null|object
     */
    public function controller($controller, callable $callback = null)
    {
        return $this->cm->controller($controller, $callback);
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
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function exception(Exception $exception, array $args = [], callable $callback = null)
    {
        return $this->cm->exception($exception, $args, $callback);
    }

    /**
     * @param callable $controller
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function dispatch(callable $controller, array $args = [], callable $callback = null)
    {
        return $this->cm->dispatch($controller, $args, $callback);
    }

    /**
     * @param ManagerInterface $cm
     */
    public function setControllerManager(ManagerInterface $cm)
    {
        $this->cm = $cm;
    }
}