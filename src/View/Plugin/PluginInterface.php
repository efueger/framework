<?php

namespace Framework\View\Plugin;

interface PluginInterface
{
    /**
     * @param string $name
     * @param null $args
     * @return null|callable|object
     */
    public function plugin($name, $args = null);
}
