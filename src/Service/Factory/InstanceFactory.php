<?php

namespace Framework\Service\Factory;

use Framework\Service\Manager\ManagerInterface;

class InstanceFactory
    implements FactoryInterface
{
    /**
     *
     */
    use ServiceTrait;

    /**
     * @var string
     */
    protected $factory;

    /**
     * @param ManagerInterface $sm
     * @param string $factory
     */
    public function __construct(ManagerInterface $sm, $factory)
    {
        $this->factory = $factory;
        $this->sm      = $sm;
    }

    /**
     * @return null|object
     */
    public function __invoke()
    {
        return $this->newInstanceArgs($this->factory, func_get_args());
    }
}
