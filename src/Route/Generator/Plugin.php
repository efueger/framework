<?php

namespace Framework\Route\Generator;

use Framework\Route\Route\ServiceTrait as RouteTrait;

class Plugin
    implements PluginInterface
{
    /**
     *
     */
    use ServiceTrait,
        RouteTrait;

    /**
     * @param null|string $name
     * @param array $params
     * @return string
     */
    public function __invoke($name = null, array $params = [])
    {
        return $this->generate($name ?: $this->route()->name(), $params);
    }
}
