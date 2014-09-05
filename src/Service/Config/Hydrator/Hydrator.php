<?php

namespace Framework\Service\Config\Hydrator;

use Framework\Service\Config\ConfigInterface;
use Framework\Service\Config\FactoryInterface;
use Framework\Service\Config\ConfigTrait;

class Hydrator
    implements ConfigInterface, FactoryInterface, HydratorInterface
{
    /**
     *
     */
    use ConfigTrait;

    /**
     * @param string $name
     * @param array $calls
     */
    public function __construct($name, array $calls)
    {
        $this->config = [
            self::CALLS => $calls,
            self::NAME  => $name
        ];
    }
}
