<?php

namespace Framework\Application;

use ArrayAccess;

interface WebApplication
    extends ArrayAccess
{
    /**
     * @param array|callable|object|string $config
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     */
    function call($config, array $args = [], callable $callback = null);

    /**
     * @param string $name
     * @param array|string|callable|object $controller
     */
    function home($name, $controller);

    /**
     * @param string $name
     * @return mixed
     */
    function param($name);

    /**
     * @param array|string $route
     * @param array|string|callable|object $controller
     */
    function route($route, $controller);

    /**
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     */
    function __invoke(array $args = [], callable $callback = null);
}
