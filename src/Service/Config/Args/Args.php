<?php

namespace Framework\Service\Config\Args;

class Args
    implements Arguments
{
    /**
     * @var array
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
     * @return array
     */
    public function config()
    {
        return $this->config;
    }
}
