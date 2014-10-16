<?php

namespace Framework\Route\Generator;

interface PluginInterface
{
    /**
     * @param null $name
     * @param array $args
     * @return string
     */
    function __invoke($name = null, array $args = []);
}
