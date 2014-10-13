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
    function create($config, array $args = []);

    /**
     * @param string $name
     * @param array $args
     * @param callable $callback
     * @return callable|null|object
     */
    function get($name, array $args = [], callable $callback = null);
}
