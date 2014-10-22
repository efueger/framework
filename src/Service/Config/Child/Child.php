<?php

namespace Framework\Service\Config\Child;

use Framework\Service\Config\Configuration;
use Framework\Service\Config\ConfigTrait;

class Child
    implements Config, Configuration
{
    /**
     *
     */
    use ChildTrait;
    use ConfigTrait;

    /**
     * @param string $name
     * @param string $parent
     */
    public function __construct($name, $parent)
    {
        $this->config = [
            self::NAME   => $name,
            self::PARENT => $parent
        ];
    }
}
