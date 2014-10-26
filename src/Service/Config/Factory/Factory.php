<?php

namespace Framework\Service\Config\Factory;

use Framework\Service\Config\Child\Base;

class Factory
    implements ServiceFactory
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->config = [
            self::NAME   => $name,
            self::PARENT => self::FACTORY
        ];
    }
}
