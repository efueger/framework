<?php

namespace Framework\Response;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param array $args
     * @return mixed
     */
    function __invoke(EventInterface $event, array $args = []);
}
