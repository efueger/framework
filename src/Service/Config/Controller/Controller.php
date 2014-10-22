<?php

namespace Framework\Service\Config\Controller;

use Framework\Service\Config\Child\ChildService;
use Framework\Service\Config\Child\ChildConfig;
use Framework\Service\Config\Configuration;
use Framework\Service\Config\ServiceConfig;

class Controller
    implements ChildService, Configuration, ControllerService
{
    /**
     *
     */
    use ChildConfig;
    use ServiceConfig;

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
