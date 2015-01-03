<?php

namespace Framework\Route\Builder;

use Framework\Route\Definition\Definition;

interface CreateRoute
{
    /**
     * @param array|Definition $definition
     * @return Definition
     */
    function __invoke($definition);
}
