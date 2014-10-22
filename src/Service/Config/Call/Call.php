<?php

namespace Framework\Service\Config\Call;

class Call
    implements ServiceCall
{
    /**
     * @var array
     */
    protected $args;

    /**
     * @var string
     */
    protected $config;

    /**
     * @param $config
     * @param array $args
     */
    public function __construct($config, array $args = [])
    {
        $this->args   = $args;
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function args()
    {
        return $this->args;
    }

    /**
     * @return string
     */
    public function config()
    {
        return $this->config;
    }
}
