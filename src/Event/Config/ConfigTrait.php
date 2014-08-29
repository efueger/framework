<?php

namespace Framework\Event\Config;

use Framework\Config\ConfigTrait as BaseConfig;

trait ConfigTrait
{
    /**
     *
     */
    use BaseConfig;

    /**
     * @param string $name
     * @param string|callable $listener
     * @param $priority
     * @return void
     */
    public function add($name, $listener, $priority = ConfigInterface::PRIORITY)
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
        if (!isset($this->config[$name])) {
            return [];
        }

        ksort($this->config[$name], SORT_NUMERIC);

        return $this->config[$name];
    }

    /**
     * @param string|callable $listener
     * @return void
     */
    public function remove($listener)
    {
        foreach($this->config as $name => $listeners) {
            foreach(array_keys($listeners) as $priority) {
                $this->config[$name][$priority] = array_diff($this->config[$name][$priority], [$listener]);
            }
        }
    }
}
