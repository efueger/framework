<?php

namespace Framework\Event\Config;

use Framework\Config\ConfigTrait as Base;

trait ConfigTrait
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     * @param string|callable $listener
     * @param $priority
     * @return void
     */
    public function add($name, $listener, $priority = Configuration::PRIORITY)
    {
        if (!isset($this->config[$name])) {
            $this->config[$name] = [];
        }

        $this->config[$name][$priority][] = $listener;
    }

    /**
     * @param $name
     * @return array
     */
    public function queue($name)
    {
        return isset($this->config[$name]) ? $this->config[$name] : [];
    }
}
