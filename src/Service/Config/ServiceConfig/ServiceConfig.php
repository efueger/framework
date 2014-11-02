<?php

namespace Framework\Service\Config\ServiceConfig;

use Framework\Service\Resolver\Resolvable;

class ServiceConfig
    implements Resolvable, ServiceConfiguration
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }
}
