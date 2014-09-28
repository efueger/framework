<?php

namespace Framework\Service\Config\Hydrator;

use Framework\Service\Config\ConfigInterface;
use Framework\Service\Config\ResolverInterface;
use Framework\Service\Config\ConfigTrait;

class Hydrator
    implements ConfigInterface, HydratorInterface, ResolverInterface
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
