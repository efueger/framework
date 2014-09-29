<?php

namespace Framework\Mvc\Route;

use Framework\Mvc\EventInterface;

interface ListenerInterface
{
    /**
     * @param EventInterface $event
     * @param array $options
     * @return mixed
     */
    function __invoke(EventInterface $event, array $options = []);
}
