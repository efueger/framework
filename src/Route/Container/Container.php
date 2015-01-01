<?php

namespace Framework\Route\Container;

use Framework\Route\Builder\DefinitionBuilder;
use Framework\Route\Definition\Definition;

class Container
    implements Routes
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
    public function add($definition)
    {
        return $this->builder->addChild($this->routes, $definition, explode('/', $definition[Definition::NAME]), true);
    }

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public function __invoke($definition)
    {
        return $this->add($definition);
    }
}
