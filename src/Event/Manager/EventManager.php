<?php
/**
 *
 */

namespace Framework\Event\Manager;

use Framework\Event\Event;

interface EventManager
{
    /**
     * @param array|Event|string $event
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    function trigger($event, array $args = [], callable $callback = null);
}
