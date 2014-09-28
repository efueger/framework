<?php

namespace Framework\Service\Config\Invoke;

use Framework\Service\Config\ResolverInterface;

class Invoke
    implements InvokeInterface, ResolverInterface
{
    /**
     * @var array
     */
    protected $args = [];

    /**
     * @var string|array|ResolverInterface
     */
    protected $service;

    /**
     * @param string|array|ResolverInterface $service
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
     * @return string|array|ResolverInterface
     */
    public function service()
    {
        return $this->service;
    }
}
