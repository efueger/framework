<?php

namespace Framework\Route\Generator;

interface PluginInterface
{
    /**
     * @param null $name
     * @param array $params
     * @return string
     */
    public function url($name = null, array $params = []);
}
