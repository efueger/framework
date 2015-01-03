<?php

namespace Framework\Route\Builder;

use Framework\Route\Definition\Definition;

class Add
    implements AddRoute
{
    /**
     * @var DefinitionBuilder
     */
    protected $builder;

    /**
     * @var Definition
     */
    protected $routes;

    /**
     * @param DefinitionBuilder $builder
     * @param Definition $routes
     */
    public function __construct(DefinitionBuilder $builder, Definition $routes)
    {
        $this->builder = $builder;
        $this->routes  = $routes;
    }

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public function __invoke($definition)
    {
        return $this->builder->addChild($this->routes, $definition, explode('/', $definition[Definition::NAME]), true);
    }
}
