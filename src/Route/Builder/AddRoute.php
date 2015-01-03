<?php
/**
 *
 */

namespace Framework\Route\Builder;

use Framework\Route\Definition\Definition;

interface AddRoute
{
    /**
     * @param array|Definition $definition
     * @return Definition
     */
    function __invoke($definition);
}
