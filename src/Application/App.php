<?php

namespace Framework\Application;

use Framework\Config\Configuration;
use Framework\Event\Manager\EventManager;
use Framework\Event\Manager\Events;
use Framework\Service\Manager\ServiceManager;

class App
    implements Application, EventManager, ServiceManager
{
    /**
     *
     */
    use Events;

    /**
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->alias    = $config->get(self::ALIAS);
        $this->config   = $config;
        $this->events   = $config->get(self::EVENTS);
        $this->services = $config->get(self::SERVICES);
    }
}
