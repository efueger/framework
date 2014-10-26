<?php

namespace Framework\Service\Config\Controller;

use Framework\Service\Config\Child\Base;

class Controller
    implements ControllerService
{
    /**
     *
     */
    use Base;

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
