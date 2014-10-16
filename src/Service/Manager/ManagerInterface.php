<?php

namespace Framework\Service\Manager;

use Framework\Service\Container\ContainerInterface;
use RuntimeException;

interface ManagerInterface
    extends ContainerInterface
{
    /**
     * @param array|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     * @throws RuntimeException
     */
    function call($config, array $args = [], callable $callback = null);

    /**
     * @param array|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|null|object
     */
    function create($config, array $args = [], callable $callback = null);

    /**
     * @param string $name
     * @param array $args
     * @param callable $callback
     * @return callable|null|object
     */
    function get($name, array $args = [], callable $callback = null);

    /**
     * @param $name
     * @return mixed
     */
    function param($name);

    /**
     * @param $name
     * @param callable $callback
     * @return callable|null|object
     */
    function plugin($name, callable $callback = null);
}
