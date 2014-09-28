<?php

namespace Framework\Service\Provider;

use Framework\Service\Config\Call\CallInterface as Call;
use Framework\Service\Config\Child\ChildInterface as Child;
use Framework\Service\Config\ConfigInterface as Config;
use Framework\Service\Config\ConfigLink\ConfigLinkInterface as ConfigLink;
use Framework\Service\Config\Dependency\DependencyInterface as Dependency;
use Framework\Service\Config\Factory\FactoryInterface as Factory;
use Framework\Service\Config\ResolverInterface as Resolver;
use Framework\Service\Config\Service\Service as Service;
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
     * @param ServiceManager $sm
     */
    public function __construct(ServiceManager $sm)
    {
        $this->sm = $sm;
    }

    /**
     * @param $config
     * @param array $args
     * @return callable|null|object
     */
    public function __invoke($config, array $args = [])
    {
        /** @var Config|Resolver $config */

        if (!$config instanceof Resolver) {
            return $this->resolve(new Service($config), $args);
        }

        if ($config instanceof Factory) {
            /** @var Child $config */
            return $this->call($this->child($config, $args));
        }

        if ($config instanceof Child) {
            /** @var Child $config */
            return $this->child($config, $args);
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

        return $this->resolve($config, $args);
    }
}
