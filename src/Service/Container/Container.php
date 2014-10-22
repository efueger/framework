<?php

namespace Framework\Service\Container;

use Framework\Config\Configuration;

class Container
    implements ServiceContainer
{
    /**
     * @var array
     */
    protected $assigned = [];

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
     * @param string $name
     * @param array|callable|object|string $config
     * @return void
     */
    public function assign($name, $config)
    {
        $this->assigned[$name] = $config;
    }

    /**
     * @param string $name
     * @return array|callable|null|object|string
     */
    public function assigned($name)
    {
        return isset($this->assigned[$name]) ? $this->assigned[$name] : null;
    }

    /**
     * @return Configuration
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
     * @return mixed
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
}
