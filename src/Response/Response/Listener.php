<?php

namespace Framework\Response\Response;

use Framework\View\Model\ServiceTrait as ViewModel;

class Listener
    implements ListenerInterface
{
    /**
     *
     */
    use ViewModel;

    /**
     * @param EventInterface $event
     * @param null $options
     * @return mixed
     */
    public function __invoke(EventInterface $event, $options = null)
    {
        return $event->response();
    }
}
