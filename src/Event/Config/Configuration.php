<?php

namespace Framework\Event\Config;

use Framework\Config\Configuration as Base;

interface Configuration
    extends Base
{
    /**
     * Default priority
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
