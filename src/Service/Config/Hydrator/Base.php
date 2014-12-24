<?php

namespace Framework\Service\Config\Hydrator;

use Framework\Service\Config\Base as Config;
use Framework\Service\Config\Configuration;

trait Base
{
    /**
     *
     */
    use Config;

    /**
     * @param string $name
     * @param array $calls
     */
    public function __construct($name, array $calls)
    {
        $this->config = [
            Configuration::CALLS => $calls,
            Configuration::NAME  => $name
        ];
    }
}
