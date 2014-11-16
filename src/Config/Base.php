<?php

namespace Framework\Config;

trait Base
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        return isset($this->config[$name]) ? $this->config[$name] : null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->config[$name]);
    }

    /**
     * @param mixed $config
     * @return bool
     */
    public function offsetExists($config)
    {
        return $this->has($config);
    }

    /**
     * @param mixed $config
     * @return mixed
     */
    public function offsetGet($config)
    {
        return $this->get($config);
    }

    /**
     * @param mixed $config
     * @param mixed $value
     */
    public function offsetSet($config, $value)
    {
        $this->set($config, $value);
    }

    /**
     * @param mixed $config
     */
    public function offsetUnset($config)
    {
        $this->remove($config);
    }

    /**
     * @param string $name
     * @return void
     */
    public function remove($name)
    {
        unset($this->config[$name]);
    }

    /**
     * @param string $name
     * @param mixed $config
     * @return void
     */
    public function set($name, $config)
    {
        $this->config[$name] = $config;
    }
}
