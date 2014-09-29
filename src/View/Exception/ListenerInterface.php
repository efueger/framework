<?php

namespace Framework\View\Exception;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @return mixed
     */
    function __invoke(EventInterface $event);
}
