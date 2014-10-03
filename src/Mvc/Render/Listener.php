<?php

namespace Framework\Mvc\Render;

use Exception;
use Framework\Mvc\EventInterface;
use Framework\View\Model\ModelInterface as View;
use Framework\View\Manager\ServiceTrait as ViewManager;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use ViewManager;

    /**
     * @param EventInterface $event
     * @param View $viewModel
     * @return mixed
     */
    public function __invoke(EventInterface $event, View $viewModel = null)
    {
        if (!$viewModel) {
            return null;
        }

        try {

            return $this->render($viewModel);

        } catch(Exception $exception) {

            return $this->exception($exception);

        }
    }
}
