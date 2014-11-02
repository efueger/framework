<?php

namespace Framework\Service\Config\Controller;

use Framework\Service\Config\Child\Base;
use Framework\Service\Resolver\Resolvable;

class Controller
    implements ControllerService, Resolvable
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     * @param array $args
     */
    public function __construct($name, array $args = [])
    {
        $this->config = [
            self::ARGS   => $args,
            self::NAME   => $name,
            self::PARENT => self::CONTROLLER
        ];
    }
}
