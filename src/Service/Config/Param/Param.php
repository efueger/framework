<?php

namespace Framework\Service\Config\Param;

use Framework\Service\Resolver\Resolvable;

class Param
    implements Resolvable, ServiceParam
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
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
