<?php

namespace Framework\Response;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param array $options
     * @return mixed
     */
    public function __invoke(EventInterface $event, array $options = []);
}
