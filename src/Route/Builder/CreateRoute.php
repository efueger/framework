<?php
/**
 *
 */

namespace Mvc5\Route\Builder;

use Mvc5\Route\Definition\Definition;

interface CreateRoute
{
    /**
     * @param array|Definition $definition
     * @return Definition
     */
    function __invoke($definition);
}
