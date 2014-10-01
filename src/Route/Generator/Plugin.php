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
     * @param array $params
     * @return string
     */
    public function url($name = null, array $params = [])
    {
        $params  = $name ? $params : $params + $this->route()->params();
        $route   = $name ?: $this->route()->name();

        return $this->generate($route, $params);
    }

    /**
     * @param null|string $name
     * @param array $params
     * @return string
     */
    public function __invoke($name = null, array $params = [])
    {
        return $this->url($name, $params);
    }
}
