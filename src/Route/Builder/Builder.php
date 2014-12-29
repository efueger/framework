<?php

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
     * @var Definition
     */
    protected $routes;

    /**
     * @param Definition $routes
     */
    public function __construct(Definition $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param array $definition
     * @return Definition
     */
    public function add(array $definition)
    {
        return $this->addChild($this->routes, $definition, explode('/', $definition[Definition::NAME]), true);
    }

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public function __invoke($definition)
    {
        return $this->definition($definition);
    }
}
