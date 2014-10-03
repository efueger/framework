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
     * @param array $options
     * @return mixed
     */
    public function exception(Exception $exception, array $options = [])
    {
        return $this->cm->exception($exception, $options);
    }

    /**
     * @param callable $controller
     * @param array $options
     * @return mixed
     */
    public function dispatch(callable $controller, array $options = [])
    {
        return $this->cm->dispatch($controller, $options);
    }

    /**
     * @param ManagerInterface $cm
     */
    public function setControllerManager(ManagerInterface $cm)
    {
        $this->cm = $cm;
    }
}