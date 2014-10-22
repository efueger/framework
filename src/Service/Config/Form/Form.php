<?php

namespace Framework\Service\Config\Form;

use Framework\Service\Config\Child\Config;
use Framework\Service\Config\Configuration;
use Framework\Service\Config\Child\ChildTrait;
use Framework\Service\Config\ConfigTrait;

class Form
    implements Config, Configuration, FormService
{
    /**
     *
     */
    use ChildTrait,
        ConfigTrait;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->config = [
            self::NAME   => $name,
            self::PARENT => self::FORM
        ];
    }
}
