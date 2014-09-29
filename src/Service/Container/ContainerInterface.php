<?php

namespace Framework\Service\Container;

use Framework\Config\ConfigInterface as Config;

interface ContainerInterface
    extends Config
{
    /**
     * @param string $name
     * @param array|callable|object|string $factory
     * @return void
     */
    public function assign($name, $factory);

    /**
     * @param string $name
     * @return array|callable|null|object|string
     */
    public function assigned($name);

    /**
     * @return Config
     */
    public function config();

    /**
     * @param string $name
     * @param mixed $config
     * @return void
     */
    public function configure($name, $config);

    /**
     * @param string $name
     * @return mixed
     */
    public function configured($name);

    /**
     * @param string $name
     * @return object
     */
    public function service($name);
}
