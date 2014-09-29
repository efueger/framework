<?php

namespace Framework\Service\Config\Controller;

use Framework\Service\Config\Child\ChildInterface;
use Framework\Service\Config\ConfigInterface;
use Framework\Service\Config\Child\ChildTrait;
use Framework\Service\Config\ConfigTrait;

class Controller
    implements ChildInterface, ConfigInterface, ControllerInterface
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
            self::PARENT => self::CONTROLLER
        ];
    }
}
