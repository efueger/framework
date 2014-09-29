<?php

namespace Framework\Route\Generator;

interface GeneratorInterface
{
    /**
     * @param string $name
     * @param array $params
     * @return string
     */
    function url($name, array $params = []);
}
