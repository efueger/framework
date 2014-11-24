<?php

namespace Framework\Service\Config\Invokable;

use Framework\Service\Resolver\Resolvable;

class Invokable
    implements Resolvable, ServiceInvokable
{
    /**
     * @var string
     */
    protected $config;

    /**
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function config()
    {
        return $this->config;
    }
}
