<?php

namespace Framework\Service\Config\Hydrator;

use Framework\Service\Config\Base;
use Framework\Service\Resolver\Resolvable;

class Hydrator
    implements Resolvable, ServiceHydrator
{
    /**
     *
     */
    use Base;

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
