<?php

namespace Framework\Mvc\Render;

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
