<?php

namespace Framework\View\Plugin;

interface PluginInterface
{
    /**
     * @param string $name
     * @param array $args
     * @return null|callable|object
     */
    function plugin($name, array $args = []);
}
