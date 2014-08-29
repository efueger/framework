<?php

namespace Framework\Service\Config\Call;

class Call
    implements CallInterface
{
    /**
     * @var string
     */
    protected $config;

    /**
     * @name string $name
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function config()
    {
        return $this->config;
    }
}
