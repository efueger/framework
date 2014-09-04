<?php

namespace Framework\Service\Config\Invoke;

use Framework\Service\Config\FactoryInterface;

class Invoke
    implements FactoryInterface, InvokeInterface
{
    /**
     * @var array
     */
    protected $args = [];

    /**
     * @var string|array|FactoryInterface
     */
    protected $service;

    /**
     * @param string|array|FactoryInterface $service
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
     * @return string|array|FactoryInterface
     */
    public function service()
    {
        return $this->service;
    }
}
