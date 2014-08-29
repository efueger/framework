<?php

namespace Framework\Service\Factory;

use Framework\Service\Manager\ManagerInterface as ServiceManager;

class AbstractFactory
    implements FactoryInterface
{
    /**
     *
     */
    use ServiceTrait;

    /**
     * @var array
     */
    protected $factory;

    /**
     * @param ServiceManager $sm
     * @param array $factory
     */
    public function __construct(ServiceManager $sm, $factory)
    {
        $this->sm      = $sm;
        $this->factory = $factory;
    }

    /**
     * @return null|object
     */
    public function __invoke()
    {
        return call_user_func_array($this->create([$this->factory[0], $this->sm, $this->factory[1]]), func_get_args());
    }
}
