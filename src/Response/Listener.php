<?php

namespace Framework\Response;

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
     * @param array $args
     * @return mixed
     */
    public function __invoke(EventInterface $event, array $args = [])
    {
        return $event->response();
    }
}
