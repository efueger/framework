<?php

namespace Framework\Mvc\Dispatch;

use Exception;
use Framework\Controller\Manager\ServiceTrait as ControllerManager;

class Dispatcher
    implements DispatcherInterface
{
    /**
     *
     */
    use ControllerManager;

    /**
     * @param $controller
     * @param array $args
     * @return mixed
     */
    public function __invoke($controller, array $args = [])
    {
        try {

            return $this->dispatch($this->controller($controller), $args);

        } catch (Exception $exception) {

            return $this->exception($exception, $args);

        }
    }
}
