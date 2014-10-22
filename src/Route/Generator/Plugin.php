<?php

namespace Framework\Route\Generator;

interface Plugin
{
    /**
     * @param null|string $name
     * @param array $args
     * @return string
     */
    function __invoke($name = null, array $args = []);
}
