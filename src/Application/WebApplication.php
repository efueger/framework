<?php
/**
 *
 */

namespace Framework\Application;

use ArrayAccess;
use Framework\Route\Definition\Definition;

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
     * @return mixed
     */
    function param($name);

    /**
     * @param array|string $route
     * @param array|callable|null|object|string $controller
     * @return Definition
     */
    function route($route, $controller = null);

    /**
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     */
    function __invoke(array $args = [], callable $callback = null);
}
