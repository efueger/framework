<?php
/**
 *
 */

namespace Framework\Service\Container;

use Framework\Config\Configuration;

interface ServiceContainer
    extends Configuration
{
    /**
     * @return array
     */
    function config();

    /**
     * @param string $name
     * @param mixed $config
     * @return void
     */
    function configure($name, $config);

    /**
     * @param string $name
     * @return array|callable|null|object|string
     */
    function configured($name);

    /**
     * @param string $name
     * @return object
     */
    function service($name);
}
