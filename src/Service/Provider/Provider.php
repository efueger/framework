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
use Framework\Service\Manager\ManagerInterface as ServiceManager;

class Provider
    implements ProviderInterface
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
     * @param array|object|string $config
     * @param array $args
     * @return callable|null|object
     */
    public function create($config, array $args = [])
    {
        if (is_array($config) && is_callable($config)) {
            return $this->invoke($config, $args);
        }

        list($config, $args) = $this->options($config, $args);

        if (is_string($config)) {
            if ($config instanceof Factory) {
                return $this->invoke(new $config($this), $args);
            }

            if (false !== strpos($config, '.')) {
                return $this->call($config, $args);
            }

            if ($assigned = $this->assigned($config)) {
                return $this->create($assigned, $args);
            }

            if ($configured = $this->configured($config)) {
                return $this->create($configured, $args);
            }

            if (is_callable($config)) {
                return $this->invoke($config, $args);
            }

            return $this->newInstanceArgs($config, $args);
        }

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
