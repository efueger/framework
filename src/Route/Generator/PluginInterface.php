<?php

namespace Framework\Route\Generator;

interface PluginInterface
{
    /**
     * @param null $name
     * @param array $args
     * @return string
     */
    function url($name = null, array $args = []);
}
