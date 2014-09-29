<?php

namespace Framework\Mvc\Render;

use Exception;
use Framework\Mvc\EventInterface;
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
     * @param array $options
     * @return mixed
     */
    public function __invoke(EventInterface $event, array $options = [])
    {
        if (!$event->viewModel()) {
            return null;
        }

        try {

            return $this->render($event->viewModel());

        } catch(Exception $exception) {

            return $this->exception($exception);

        }
    }
}
