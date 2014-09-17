<?php

namespace Framework\Response;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param null $options
     * @return mixed
     */
    public function __invoke(EventInterface $event, $options = null);
}