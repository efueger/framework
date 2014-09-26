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

            $obStartLevel = ob_get_level();

            return $this->render($event->viewModel());

        } catch(Exception $exception) {

            while(ob_get_level() > $obStartLevel) {
                ob_get_clean();
            }

            return $this->exception($exception);

        }
    }
}
