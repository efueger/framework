<?php

namespace Framework\Service\Config\Args;

class Args
    implements ArgsInterface
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @name string $array
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
