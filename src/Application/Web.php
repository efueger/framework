<?php

namespace Framework\Application;

use Framework\Config\Configuration;
use Framework\Route\Definition\Definition;

class Web
    implements WebApplication
{
    /**
     * @var Application
     */
    protected $application;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var Definition
     */
    protected $routes;

    /**
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->application = new App($config);
        $this->config      = $config;
        $this->routes      = $config[Args::ROUTES];
    }

    /**
     * @param array|callable|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     */
    public function call($config, array $args = [], callable $callback = null)
    {
        return $this->application->call($config, $args, $callback);
    }

    /**
     * @param mixed $config
     * @return bool
     */
    public function offsetExists($config)
    {
        return $this->application->has($config);
    }

    /**
     * @param mixed $config
     * @return mixed
     */
    public function offsetGet($config)
    {
        return $this->application->get($config);
    }

    /**
     * @param mixed $config
     * @param mixed $value
     */
    public function offsetSet($config, $value)
    {
        $this->application->set($config, $value);
    }

    /**
     * @param mixed $config
     */
    public function offsetUnset($config)
    {
        $this->application->remove($config);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function param($name)
    {
        return $this->application->param($name);
    }

    /**
     * @param array|string $name
     * @param array|string|callable|object $controller
     * @return Definition
     */
    public function route($name, $controller = null)
    {
        if (is_string($name)) {
            $name = explode(':', $name, 2);
            $name = [
                'name'       => $name[0],
                'route'      => isset($name[1]) ? $name[1] : null,
                'controller' => $controller
            ];
        }

        return $this->call(Args::ADD_ROUTE, [Args::DEFINITION => $name]);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->config->get($name);
    }

    /**
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     */
    public function __invoke(array $args = [], callable $callback = null)
    {
        return $this->call(Args::WEB, $args, $callback);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __isset($name)
    {
        return $this->config->has($name);
    }

    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        $this->config->set($name, $value);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __unset($name)
    {
        $this->config->remove($name);
    }
}
