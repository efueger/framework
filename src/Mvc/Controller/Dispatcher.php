<?php

namespace Framework\Mvc\Controller;

use Exception;
use Framework\Controller\Manager\ManageController;

class Dispatcher
    implements Dispatch
{
    /**
     *
     */
    use ManageController;

    /**
     * @param array|callable|object|string $controller
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
