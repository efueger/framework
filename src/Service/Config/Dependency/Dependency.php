<?php

namespace Framework\Service\Config\Dependency;

use Framework\Service\Config\ResolverInterface;

class Dependency
    implements DependencyInterface, ResolverInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }
}
