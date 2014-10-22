<?php

namespace Framework\Service\Config\Form;

use Framework\Service\Config\Child\ChildService;
use Framework\Service\Config\Configuration;
use Framework\Service\Config\Child\ChildConfig;
use Framework\Service\Config\ServiceConfig;

class Form
    implements ChildService, Configuration, FormService
{
    /**
     *
     */
    use ChildConfig,
        ServiceConfig;

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
