<?php

namespace Framework\Service\Config\Manager;

use Framework\Service\Config\Child\Base;

class Manager
    implements ServiceManager
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     * @param array $calls
     */
    public function __construct($name, array $calls = [])
    {
        $this->config = [
            self::CALLS  => $calls,
            self::MERGE  => true,
            self::NAME   => $name,
            self::PARENT => self::MANAGER
        ];
    }
}
