<?php

namespace Framework\Service\Config\Child;

use Framework\Service\Config\ConfigInterface;
use Framework\Service\Config\FactoryInterface;
use Framework\Service\Config\ConfigTrait;

class Child
    implements ConfigInterface, ChildInterface, FactoryInterface
{
    /**
     *
     */
    use ChildTrait,
        ConfigTrait;

    /**
     * @name string $name
     * @name string $parent
     */
    public function __construct($name, $parent)
    {
        $this->config = [
            self::NAME   => $name,
            self::PARENT => $parent
        ];
    }
}
