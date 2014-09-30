<?php

namespace Framework\Service\Config\Form;

use Framework\Service\Config\Child\ChildInterface;
use Framework\Service\Config\ConfigInterface;
use Framework\Service\Config\Child\ChildTrait;
use Framework\Service\Config\ConfigTrait;

class Form
    implements ChildInterface, ConfigInterface, FormInterface
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
