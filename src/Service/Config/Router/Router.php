<?php

namespace Framework\Service\Config\Router;

use Framework\Service\Config\Base;
use Framework\Service\Resolver\Resolvable;

class Router
    implements Resolvable, RouterService
{
    /**
     *
     */
    use Base;

    /**
     * @param $definition
     */
    public function __construct($definition)
    {
        $this->config = [
            self::ARGS => [$definition],
            self::NAME => self::ROUTER
        ];
    }
}
