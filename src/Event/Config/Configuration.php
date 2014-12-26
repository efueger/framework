<?php

namespace Framework\Event\Config;

use Framework\Config\Configuration as Config;

interface Configuration
    extends Config
{
    /**
     *
     */
    const PRIORITY = 0;

    /**
     * @param string $name
     * @param string|callable $listener
     * @param $priority
     * @return void
     */
    function add($name, $listener, $priority = self::PRIORITY);

    /**
     * @param string $name
     * @return array
     */
    function queue($name);
}
