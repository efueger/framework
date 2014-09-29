<?php

namespace Framework\Response;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param array $options
     * @return mixed
     */
    function __invoke(EventInterface $event, array $options = []);
}
