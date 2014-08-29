<?php

namespace Framework\Service\Factory;

use Framework\Service\Manager\ManagerInterface as ServiceManager;

class Factory
    implements FactoryInterface
{
    /**
     *
     */
    use ServiceTrait;

    /**
     * @param ServiceManager $sm
     */
    public function __construct(ServiceManager $sm)
    {
        $this->sm = $sm;
    }
}
