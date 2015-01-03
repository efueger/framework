<?php
/**
 *
 */

namespace Framework\Route\Generator;

interface RouteGenerator
{
    /**
     * @param string $name
     * @param array $args
     * @return string
     */
    function url($name, array $args = []);
}
