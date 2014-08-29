<?php

namespace Framework\Service\Factory;

use ReflectionClass;
use Framework\Config\ConfigInterface;
use Framework\Service\Manager\ManagerInterface;

trait ServiceTrait
{
    /**
     * @var ManagerInterface
     */
    protected $sm;

    /**
     * @return ConfigInterface
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
     * @param null $args
     * @return null|object|callable
     */
    public function create($name, $args = null)
    {
        return $this->sm->create($name, $args);
    }

    /**
     * @param array|string $name
     * @param null $args
     * @param bool $shared
     * @return null|object
     */
    public function get($name, $args = null, $shared = true)
    {
        return $this->sm->get($name, $args, $shared);
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
     * @param $name
     * @return object
     */
    public function service($name)
    {
        return $this->sm->service($name);
    }
}