<?php

namespace Framework\Service\Factory;

use Framework\Config\Configuration;
use Framework\Service\Manager\ServiceManager;
use ReflectionClass;

trait Base
{
    /**
     * @var ServiceManager
     */
    protected $sm;

    /**
     * @param ServiceManager $sm
     */
    public function __construct(ServiceManager $sm)
    {
        $this->sm = $sm;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function assigned($name)
    {
        return $this->sm->assigned($name);
    }

    /**
     * @return Configuration
     */
    public function config()
    {
        return $this->sm->config();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function configured($name)
    {
        return $this->sm->configured($name);
    }

    /**
     * @param string $name
     * @param array $args
     * @return null|object|callable
     */
    public function create($name, array $args = [])
    {
        return $this->sm->create($name, $args);
    }

    /**
     * @param array|string $name
     * @param array $args
     * @return null|object
     */
    public function get($name, array $args = [])
    {
        return $this->sm->get($name, $args);
    }

    /**
     * @param string $name
     * @param array $args
     * @return object
     */
    protected function newInstanceArgs($name, array $args = [])
    {
        if (!$args) {
            return new $name;
        }

        $class = new ReflectionClass($name);

        return $class->hasMethod('__construct') ? $class->newInstanceArgs($args) : $class->newInstance();
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function param($name)
    {
        return $this->sm->param($name);
    }

    /**
     * @param $name
     * @return object
     */
    public function service($name)
    {
        return $this->sm->service($name);
    }
}