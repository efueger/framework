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
     * @param null $options
     * @return mixed
     */
    public function __invoke(EventInterface $event, $options = null)
    {
        try {

            return $this->render($event->viewModel());

        } catch(Exception $exception) {

            return $this->exception($exception);

        }
    }
}
