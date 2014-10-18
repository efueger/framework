<?php

namespace Framework\Mvc\Dispatch;

use Exception;
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
        try {

            return $this->dispatch($this->controller($controller), $args, $plugin);

        } catch (Exception $exception) {

            return $this->exception($exception, $args, $plugin);

        }
    }
}
