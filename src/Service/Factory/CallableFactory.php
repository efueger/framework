<?php

namespace Framework\Service\Factory;

use Framework\Service\Manager\ManagerInterface as ServiceManager;

class CallableFactory
    implements FactoryInterface
{
    /**
     *
     */
    use ServiceTrait;

    /**
     * @var callable
     */
    protected $factory;

    /**
     * @param ServiceManager $sm
     * @param callable $factory
     */
    public function __construct(ServiceManager $sm, callable $factory)
    {
        $this->sm      = $sm;
        $this->factory = $factory;
    }

    /**
     * @return null|object
     */
    public function __invoke()
    {
        return call_user_func_array($this->factory, array_merge([$this->sm], func_get_args()));
    }
}
