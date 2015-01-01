<?php

namespace Framework\Route\Container;

use Framework\Route\Definition\Definition;

interface Routes
{
    /**
     * @param array|Definition $definition
     * @return Definition
     */
    function add($definition);
}
