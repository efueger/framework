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
     * @param array $options
     * @return string
     */
    public function __invoke($name = null, array $params = [], array $options = [])
    {
        return $this->generate($name ?: ltrim($this->route()->name(), '/') ?: '/', $params, $options);
    }
}
