<?php

namespace Framework\Route\Generator;

use Framework\Route\ServiceTrait as RouteTrait;

class Plugin
    implements RoutePlugin
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
        return $this->generate($name ?: $this->route()->name(), $name ? $args : $args + $this->route()->params());
    }
}
