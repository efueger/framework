<?php

namespace Framework\Service\Factory;

use Framework\Config\ConfigInterface as Config;

interface FactoryInterface
{
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
     * @param string $name
     * @param null $args
     * @return null|object
     */
    public function create($name, $args = null);

    /**
     * @param array|string $name
     * @param null $args
     * @param bool $shared
     * @return null|object
     */
    public function get($name, $args = null, $shared = true);

    /**
     * @param $name
     * @return object
     */
    public function service($name);
}
