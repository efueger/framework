<?php
/**
 *
 */

namespace Mvc5\Route\Builder;

use Mvc5\Route\Definition\Definition;

class Create
    implements CreateRoute
{
    /**
     *
     */
    use Base;

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public function __invoke($definition)
    {
        return $this->definition($definition);
    }
}
