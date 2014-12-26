<?php

namespace Framework\Service\Container;

use Framework\Config\ArrayAccess;
use Serializable;

class Container
    implements Serializable, ServiceContainer
{
    /**
     *
     */
    use ArrayAccess;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var array
     */
    protected $services = [];

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * @param string $name
     * @param mixed $config
     * @return void
     */
    public function configure($name, $config)
    {
        $this->config[$name] = $config;
    }

    /**
     * @param string $name
     * @return array|callable|null|object|string
     */
    public function configured($name)
    {
        return isset($this->config[$name]) ? $this->config[$name] : null;
    }

    /**
     * @param string $name
     * @return object|null
     */
    public function get($name)
    {
        return $this->service($name);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->services[$name]);
    }

    /**
     * @param string $name
     * @return void
     */
    public function remove($name)
    {
        unset($this->services[$name]);
    }

    /**
     * @param string $name
     * @return object|null
     */
    public function service($name)
    {
        return isset($this->services[$name]) ? $this->services[$name] : null;
    }

    /**
     * @param string $name
     * @param mixed $service
     * @return void
     */
    public function set($name, $service)
    {
        $this->services[$name] = $service;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize($this->config);
    }

    /**
     * @param string $config
     */
    public function unserialize($config)
    {
        $this->config = unserialize($config);
    }
}
