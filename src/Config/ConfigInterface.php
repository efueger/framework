<?php

namespace Framework\Config;

interface ConfigInterface
{
    /**
     * @param string $name
     * @return mixed
     */
    function get($name);

    /**
     * @param string $name
     * @return bool
     */
    function has($name);

    /**
     * @param string $name
     * @return void
     */
    function remove($name);

    /**
     * @param string $name
     * @param mixed $config
     * @return void
     */
    function set($name, $config);
}
