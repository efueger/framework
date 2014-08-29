<?php

namespace Framework\View\Exception;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @return mixed
     */
    public function __invoke(EventInterface $event);
}
