<?php

namespace Framework\Controller\Dispatch;

use Framework\Controller\Manager\ManageController;

class Dispatcher
    implements Action
{
    /**
     *
     */
    use ManageController;

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
