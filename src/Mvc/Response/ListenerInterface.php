<?php

namespace Framework\Mvc\Response;

use Framework\Mvc\EventInterface;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param array $options
     * @return mixed
     */
    public function __invoke(EventInterface $event, array $options = []);
}
