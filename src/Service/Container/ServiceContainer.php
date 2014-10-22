<?php

namespace Framework\Service\Container;

use Framework\Config\Configuration;

interface ServiceContainer
    extends Configuration
{
    /**
     * @param string $name
     * @param array|callable|object|string $config
     * @return void
     */
    function assign($name, $config);

    /**
     * @param string $name
     * @return array|callable|null|object|string
     */
    function assigned($name);

    /**
     * @return Configuration
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
