<?php

namespace Framework\Service\Factory;

use Framework\Config\ConfigInterface as Config;

interface FactoryInterface
{
    /**
     * @param $name
     * @return mixed
     */
    public function assigned($name);

    /**
     * @return Config
     */
    public function config();

    /**
     * @param $name
     * @return mixed
     */
    public function configured($name);

    /**
     * @param array|object|string $config
     * @param array $args
     * @return null|object
     */
    public function create($config, array $args = []);

    /**
     * @param string $name
     * @param array $args
     * @param bool $shared
     * @return null|object
     */
    public function get($name, array $args = [], $shared = true);

    /**
     * @param $name
     * @return object
     */
    public function service($name);
}
