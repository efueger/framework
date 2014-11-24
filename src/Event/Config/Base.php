<?php

namespace Framework\Event\Config;

use Framework\Config\Base as Config;

trait Base
{
    /**
     *
     */
    use Config;

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
     * @param string $name
     * @return array
     */
    public function queue($name)
    {
        if (!isset($this->config[$name])) {
            return [];
        }

        ksort($this->config[$name], SORT_NUMERIC);

        return $this->config[$name];
    }
}
