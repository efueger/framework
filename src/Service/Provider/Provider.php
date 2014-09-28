<?php

namespace Framework\Service\Provider;

use Framework\Service\Config\Call\CallInterface as Call;
use Framework\Service\Config\Child\ChildInterface as Child;
use Framework\Service\Config\ConfigInterface as Config;
use Framework\Service\Config\ConfigLink\ConfigLinkInterface as ConfigLink;
use Framework\Service\Config\Dependency\DependencyInterface as Dependency;
use Framework\Service\Config\Factory\FactoryInterface as Factory;
use Framework\Service\Config\ResolverInterface as Resolver;
use Framework\Service\Config\Invoke\InvokeInterface as Invoke;
use Framework\Service\Config\ServiceManagerLink\ServiceManagerLinkInterface as ServiceManagerLink;
use Framework\Service\Factory\FactoryInterface;
use Framework\Service\Manager\ManagerInterface as ServiceManager;

class Provider
    implements FactoryInterface, ProviderInterface
{
    /**
     *
     */
    use ProviderTrait;

    /**
     * @var Resolver $config
     */
    protected $config;

    /**
     * @param ServiceManager $sm
     * @param Resolver $config
     */
    public function __construct(ServiceManager $sm, Resolver $config)
    {
        $this->config = $config;
        $this->sm     = $sm;
    }

    /**
     * @return callable|null|object
     */
    public function __invoke()
    {
        /** @var Config|Resolver $config */

        $config = $this->config;

        if ($config instanceof Factory) {
            /** @var Child $config */
            return $this->call($this->child($config, func_get_args()));
        }

        if ($config instanceof Child) {
            /** @var Child $config */
            return $this->child($config, func_get_args());
        }

        if ($config instanceof Dependency) {
            return $this->get($config->name());
        }

        if ($config instanceof Call) {
            return $this->invoke($config->config(), $config->args());
        }

        if ($config instanceof ConfigLink) {
            return $this->config();
        }

        if ($config instanceof ServiceManagerLink) {
            return $this->sm;
        }

        if ($config instanceof Invoke) {
            return function() use ($config) {
                /** @var Invoke $config */
                return $this->invoke($config->service(), $config->args());
            };
        }

        return $this->di($config, func_get_args());
    }
}
