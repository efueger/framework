<?php
/**
 *
 */

namespace Mvc5\Service\Container;

use Mvc5\Config\ArrayAccess;
use Mvc5\Config\Configuration;

trait Service
{
    /**
     *
     */
    use ArrayAccess;

    /**
     * @var array|Configuration
     */
    protected $config;

    /**
     * @var ServiceContainer
     */
    protected $services;

    /**
     * @return array|Configuration
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * @param array|Configuration $config
     */
    public function configuration($config)
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
     * @return array|callable|null|object|string
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
     * @param ServiceContainer $services
     */
    public function services(ServiceContainer $services)
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
