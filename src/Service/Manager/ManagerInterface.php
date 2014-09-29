<?php

namespace Framework\Service\Manager;

use Framework\Service\Container\ContainerInterface;

interface ManagerInterface
    extends ContainerInterface
{
    /**
     * @param array|object|string $config
     * @param array $args
     * @return callable|null|object
     */
    public function create($config, array $args = []);

    /**
     * @param string $name
     * @param array $args
     * @param bool $shared
     * @return callable|null|object
     */
    public function get($name, array $args = [], $shared = true);
}
