<?php

namespace Framework\Service\Container;

use Framework\Config\ConfigInterface as Config;
use Framework\Config\ConfigTrait;

trait ServiceTrait
{
    /**
     *
     */
    use ConfigTrait;

    /**
     * @var ContainerInterface
     */
    protected $services;

    /**
     * @param string $name
     * @param array|callable|object|string $factory
     * @return void
     */
    public function assign($name, $factory)
    {
        $this->services->assign($name, $factory);
    }

    /**
     * @param string $name
     * @return array|callable|null|object|string
     */
    public function assigned($name)
    {
        return $this->services->assigned($name);
    }

    /**
     * @return Config
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * @param Config $config
     */
    public function configuration(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $name
     * @param mixed $config
     * @return void
     */
    public function configure($name, $config)
    {
        $this->services->configure($name, $config);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function configured($name)
    {
        return $this->services->configured($name);
    }

    /**
     * @param string $name
     * @return object|null
     */
    public function get($name)
    {
        return $this->services->get($name);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return $this->services->has($name);
    }

    /**
     * @param string $name
     * @return void
     */
    public function remove($name)
    {
        $this->services->remove($name);
    }

    /**
     * @param string $name
     * @return object|null
     */
    public function service($name)
    {
        return $this->services->service($name);
    }

    /**
     * @param ContainerInterface $services
     */
    public function services(ContainerInterface $services)
    {
        $this->services = $services;
    }

    /**
     * @param string $name
     * @param mixed $service
     * @return void
     */
    public function set($name, $service)
    {
        $this->services->set($name, $service);
    }
}
