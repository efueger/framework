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
     * @param callable $plugin
     * @return mixed
     */
    public function __invoke($controller, array $args = [], callable $plugin = null)
    {
        return $this->action($controller, $args, $plugin);
    }
}
