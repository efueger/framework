<?php

namespace Framework\Controller\Action;

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
        return $this->action($controller, $args);
    }
}
