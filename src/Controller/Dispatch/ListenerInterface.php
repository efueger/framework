<?php

namespace Framework\Controller\Dispatch;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param array $options
     * @return mixed
     */
    function __invoke(EventInterface $event, array $options = []);
}
