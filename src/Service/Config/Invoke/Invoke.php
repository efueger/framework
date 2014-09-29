<?php

namespace Framework\Service\Config\Invoke;

class Invoke
    implements InvokeInterface
{
    /**
     * @var array
     */
    protected $args = [];

    /**
     * @var string|array
     */
    protected $service;

    /**
     * @param string|array $service
     * @param array $args
     */
    public function __construct($service, array $args = [])
    {
        $this->args    = $args;
        $this->service = $service;
    }

    /**
     * @return array
     */
    public function args()
    {
        return $this->args;
    }

    /**
     * @return string|array
     */
    public function service()
    {
        return $this->service;
    }
}
