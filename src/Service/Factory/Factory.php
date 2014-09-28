<?php

namespace Framework\Service\Factory;

use Framework\Service\Manager\ManagerInterface as ServiceManager;

abstract class Factory
    implements FactoryInterface
{
    /**
     *
     */
    use FactoryTrait;

    /**
     * @param ServiceManager $sm
     */
    public function __construct(ServiceManager $sm)
    {
        $this->sm = $sm;
    }
}
