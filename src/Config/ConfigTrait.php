<?php

namespace Framework\Config;

trait ConfigTrait
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
     * @param mixed $config
     * @return void
     */
    public function add($name, $config)
    {
        $this->config[$name] = $config;
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
     * @param string $name
     * @return void
     */
    public function remove($name)
    {
        unset($this->config[$name]);
    }

    /**
     * @return string|void
     */
    public function serialize()
    {
        return serialize($this->config);
    }

    /**
     * @param string $serialized
     * @return void|ConfigInterface
     */
    public function unserialize($serialized)
    {
        $this->__construct(unserialize($serialized));
    }
}
