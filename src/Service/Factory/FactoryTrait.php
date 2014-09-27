<?php

namespace Framework\Service\Factory;

use Closure;
use Framework\Service\Config\FactoryInterface as ServiceConfig;
use Framework\Service\Manager\ManagerInterface;

trait FactoryTrait
{
    /**
     * @param array|callable|Closure|FactoryInterface|object|ServiceConfig|string $factory
     * @return callable|FactoryInterface|null
     */
    protected function factory($factory)
    {
        /** @var ManagerInterface $this */

        if (is_string($factory)) {
            if (is_subclass_of($factory, Factory::class)) {
                return new $factory($this);
            }

            if (is_callable($factory)) {
                return new CallableFactory($this, $factory);
            }

            return new InstanceFactory($this, $factory);
        }

        if (is_object($factory)) {

            if ($factory instanceof ServiceConfig) {
                return new ServiceFactory($this, $factory);
            }

            if ($factory instanceof Closure) {
                return $factory::bind($factory, $this);
            }

        } elseif (is_callable($factory)) {

            return new CallableFactory($this, $factory);

        }

        return null;
    }
}