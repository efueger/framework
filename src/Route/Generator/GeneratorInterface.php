<?php

namespace Framework\Route\Generator;

interface GeneratorInterface
{
    /**
     * @param string $name
     * @param array $params
     * @param array $options
     * @return string
     */
    public function url($name, array $params = [], array $options = []);
}
