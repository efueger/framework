<?php

namespace Framework\Service\Config\Hydrator;

use Framework\Service\Config\Configuration;
use Framework\Service\Config\ConfigTrait;

class Hydrator
    implements Configuration, ServiceHydrator
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
