<?php

namespace Framework\Service\Manager;

use Framework\Service\Container\ServiceContainer;
use RuntimeException;

interface ServiceManager
    extends ServiceContainer
{
    /**
     * @param array|callable|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     * @throws RuntimeException
     */
    function call($config, array $args = [], callable $callback = null);

    /**
     * @param array|callable|null|object|string $config
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
     * @param string $name
     * @return mixed
     */
    function param($name);

    /**
     * @param string $name
     * @param callable $callback
     * @return callable|null|object
     */
    function plugin($name, callable $callback = null);

    /**
     * @param string $name
     * @param callable $callback
     * @return mixed
     */
    function __invoke($name, callable $callback = null);
}
