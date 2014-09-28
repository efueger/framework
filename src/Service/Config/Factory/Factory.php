<?php

namespace Framework\Service\Config\Factory;

use Framework\Service\Config\Child\ChildInterface;
use Framework\Service\Config\ConfigInterface;
use Framework\Service\Config\ResolverInterface;
use Framework\Service\Config\Child\ChildTrait;
use Framework\Service\Config\ConfigTrait;

class Factory
    implements ChildInterface, ConfigInterface, FactoryInterface, ResolverInterface
{
    /**
     *
     */
    use ChildTrait,
        ConfigTrait;

    /**
     * @name string $name
     */
    public function __construct($name)
    {
        $this->config = [
            self::NAME   => $name,
            self::PARENT => self::FACTORY
        ];
    }
}