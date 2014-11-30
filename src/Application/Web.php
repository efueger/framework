<?php

namespace Framework\Application;

use Framework\Config\Configuration;
use Framework\Route\Definition\Definition;
use Framework\Route\Definition\RouteDefinition;

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
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->application = new App($config);
        $this->config      = $config;
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
     * @param array|string $route
     * @param array|callable|null|object|string $controller
     * @return Definition
     */
    public function route($route, $controller = null)
    {
        is_array($route) && !is_string(key($route)) && $route = [
            Definition::NAME        => $route[0],
            Definition::ROUTE       => isset($route[1]) ? $route[1] : null,
            Definition::CONSTRAINTS => isset($route[2]) ? $route[2] : [],
            Definition::DEFAULTS    => isset($route[4]) ? $route[3] : [],
            Definition::CONTROLLER  => isset($route[4]) ? $route[4] : isset($route[3]) ? $route[3] : []
        ];

        is_string($route) && $route = [
            Definition::NAME       => $route,
            Definition::CONTROLLER => $controller
        ];

        if (isset($this->config[Args::ROUTES])) {
            return $this->call(Args::ADD_ROUTE, [Args::DEFINITION => $route]);
        }

        empty($route[Definition::ROUTE]) && $route[Definition::ROUTE] = '/';

        return $this->config[Args::ROUTES] = new RouteDefinition($route);
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
