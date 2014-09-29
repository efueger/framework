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
    function assign($name, $factory);

    /**
     * @param string $name
     * @return array|callable|null|object|string
     */
    function assigned($name);

    /**
     * @return Config
     */
    function config();

    /**
     * @param string $name
     * @param mixed $config
     * @return void
     */
    function configure($name, $config);

    /**
     * @param string $name
     * @return mixed
     */
    function configured($name);

    /**
     * @param string $name
     * @return object
     */
    function service($name);
}
