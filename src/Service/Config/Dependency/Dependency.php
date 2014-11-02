<?php

namespace Framework\Service\Config\Dependency;

use Framework\Service\Resolver\Resolvable;

class Dependency
    implements Resolvable, ServiceDependency
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
