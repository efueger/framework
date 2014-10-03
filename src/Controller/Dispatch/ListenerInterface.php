<?php

namespace Framework\Controller\Dispatch;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param array $eventArgs
     * @return mixed
     */
    function __invoke(EventInterface $event, array $eventArgs = []);
}
