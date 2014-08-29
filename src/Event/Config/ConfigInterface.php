<?php

namespace Framework\Event\Config;

use Framework\Config\ConfigInterface as BaseConfig;

interface ConfigInterface
    extends BaseConfig
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
    public function add($name, $listener, $priority = self::PRIORITY);

    /**
     * @param string $name
     * @return array
     */
    public function queue($name);
}
