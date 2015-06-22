<?php
/**
 *
 */

namespace Mvc5\Service\Config\ServiceProvider;

use Mvc5\Service\Config\Configuration;
use Mvc5\Service\Config\Hydrator\Base;
use Mvc5\Service\Config\Hydrator\ServiceHydrator;
use Mvc5\Service\Config\ServiceManagerLink\ServiceManagerLink;
use Mvc5\Service\Resolver\Resolvable;

class ServiceProvider
    implements Provider, Resolvable, ServiceHydrator
{
    /**
     *
     */
    use Base;

    /**
     * @param string $name
     * @param array $calls
     */
    public function __construct($name, array $calls = [])
    {
        $this->config = [
            Configuration::CALLS => $calls + ['provider' => new ServiceManagerLink],
            Configuration::NAME  => $name
        ];
    }
}
