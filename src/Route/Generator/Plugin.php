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
     * @param null $name
     * @param array $args
     * @return string
     */
    public function url($name = null, array $args = [])
    {
        return $this->generate($name ?: $this->route()->name(), $name ? $args : $args + $this->route()->params());
    }

    /**
     * @param null|string $name
     * @param array $args
     * @return string
     */
    public function __invoke($name = null, array $args = [])
    {
        return $this->url($name, $args);
    }
}
