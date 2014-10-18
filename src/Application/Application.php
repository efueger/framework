<?php

namespace Framework\Application;

use Framework\Config\ConfigInterface as Config;
use Framework\Event\Manager\EventManagerInterface;
use Framework\Event\Manager\EventsTrait as Events;
use Framework\Service\Manager\ManagerInterface as ServiceManagerInterface;

class Application
    implements ApplicationInterface, EventManagerInterface, ServiceManagerInterface
{
    /**
     *
     */
    use Events;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->alias    = $config->get(self::ALIAS);
        $this->config   = $config;
        $this->events   = $config->get(self::EVENTS);
        $this->services = $config->get(self::SERVICES);
    }
}
