<?php
/**
 *
 */

namespace Framework\Route\Builder;

use Framework\Route\Definition\Definition;

class Builder
    implements DefinitionBuilder
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
        return $this->url($definition);
    }
}
