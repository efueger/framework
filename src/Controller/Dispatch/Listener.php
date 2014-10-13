<?php

namespace Framework\Controller\Dispatch;

use Framework\Controller\Manager\ServiceTrait as ControllerManager;

class Listener
    implements ListenerInterface
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
