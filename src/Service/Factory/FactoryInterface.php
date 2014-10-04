<?php

namespace Framework\Service\Factory;

use Framework\Config\ConfigInterface as Config;

interface FactoryInterface
{
    /**
     * @param $name
     * @return mixed
     */
    function assigned($name);

    /**
     * @return Config
     */
    function config();

    /**
     * @param $name
     * @return mixed
     */
    function configured($name);

    /**
     * @param array|object|string $config
     * @param array $args
     * @return null|object
     */
    function create($config, array $args = []);

    /**
     * @param string $name
     * @param array $args
     * @return null|object
     */
    function get($name, array $args = []);

    /**
     * @param $name
     * @return object
     */
    function service($name);
}
