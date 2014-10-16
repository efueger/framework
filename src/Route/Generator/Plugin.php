<?php

namespace Framework\Route\Generator;

use Framework\Route\Route\ServiceTrait as RouteTrait;

class Plugin
    implements PluginInterface
{
    /**
     *
     */
    use RouteTrait;
    use ServiceTrait;

    /**
     * @param null|string $name
     * @param array $args
     * @return string
     */
    public function __invoke($name = null, array $args = [])
    {
        return $this->url($name ?: $this->route()->name(), $name ? $args : $args + $this->route()->params());
    }
}
