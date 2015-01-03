<?php
/**
 *
 */

namespace Framework\Service\Config\Service;

use Framework\Service\Config\Base;
use Framework\Service\Resolver\Resolvable;

class Service
    implements Config, Resolvable
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     * @param array $args
     * @param array $calls
     */
    public function __construct($name, array $args = [], array $calls = [])
    {
        $this->config = [
            self::ARGS  => $args,
            self::CALLS => $calls,
            self::NAME  => $name
        ];
    }
}
