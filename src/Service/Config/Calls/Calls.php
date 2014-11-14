<?php

namespace Framework\Service\Config\Calls;

use Framework\Service\Config\Base;
use Framework\Service\Resolver\Resolvable;

class Calls
    implements Resolvable, ServiceCalls
{
    /**
     *
     */
    use Base;

    /**
     * @param string|object $name
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
