<?php

namespace Framework\Service\Provider;

use Closure;
use Framework\Service\Config\Call\CallInterface as Call;
use Framework\Service\Config\Child\ChildInterface as Child;
use Framework\Service\Config\ConfigInterface as Config;
use Framework\Service\Config\ConfigLink\ConfigLinkInterface as ConfigLink;
use Framework\Service\Config\Dependency\DependencyInterface as Dependency;
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
     * @var array|callable|Closure|FactoryInterface|object|Resolver|string $config
     */
    protected $config;

    /**
     * @param ServiceManager $sm
     * @param array|callable|Closure|FactoryInterface|object|Resolver|string $config
     */
    public function __construct(ServiceManager $sm, $config)
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

        if ($config instanceof Child) {

            /** @var Child|Config $config */

            $config->add(Config::NAME, $this->arg($config->name()));

            return $this->di($this->merge($config, $this->configured($config->parent())), func_get_args());
        }

        if ($config instanceof Invoke) {
            return function() use ($config) {
                /** @var Invoke $config */
                return $this->invoke($config->service(), $config->args());
            };
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

        return $this->di($config, func_get_args());
    }
}
