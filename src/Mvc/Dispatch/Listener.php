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
     * @param callable $plugins
     * @return mixed
     */
    public function __invoke($controller, array $args = [], callable $plugins = null)
    {
        try {

            return $this->dispatch($this->controller($controller, $plugins), $args, $plugins);

        } catch (Exception $exception) {

            return $this->exception($exception, $args);

        }
    }
}
