<?php

namespace Framework\Service\Config\Router;

use Framework\Service\Config\Configuration;
use Framework\Service\Config\ConfigTrait;

class Router
    implements Configuration, RouterService
{
    /**
     *
     */
    use ConfigTrait;

    /**
     * @param $definition
     */
    public function __construct($definition)
    {
        $this->config = [
            self::NAME => self::ROUTER,
            self::ARGS => [$definition]
        ];
    }
}
