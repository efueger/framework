<?php

namespace Framework\Route\Generator;

interface GeneratorInterface
{
    /**
     * @param string $name
     * @param array $args
     * @return string
     */
    function url($name, array $args = []);
}
