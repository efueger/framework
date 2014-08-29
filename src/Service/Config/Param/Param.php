<?php

namespace Framework\Service\Config\Param;

class Param
    implements ParamInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @name string $name
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
