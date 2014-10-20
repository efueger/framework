<?php

namespace Framework\Service\Config\Router;

use Framework\Service\Config\ConfigInterface;
use Framework\Service\Config\ConfigTrait;

class Router
    implements ConfigInterface, RouterInterface
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
