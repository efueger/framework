<?php

namespace Framework\Service\Manager;

use Framework\Service\Container\ContainerInterface;

interface ManagerInterface
    extends ContainerInterface
{
    /**
     * @param string $name
     * @param mixed $service
     * @return void
     */
    public function add($name, $service);

    /**
     * @param array|string $name
     * @param null $args
     * @return null|object|callable
     */
    public function create($name, $args = null);

    /**
     * @param array|string $name
     * @param null $args
     * @param bool $shared
     * @return null|object|callable
     */
    public function get($name, $args = null, $shared = true);
}
