<?php

namespace Framework\Application;

use Framework\Config\ConfigInterface as Config;
use Framework\Event\Manager\EventManagerInterface;
use Framework\Event\Manager\EventsTrait as Events;
use Framework\Mvc\EventInterface as Event;
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
        $this->config   = $config;
        $this->events   = $config->get(self::EVENTS);
        $this->services = $config->get(self::SERVICES);
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function __invoke(array $args = [])
    {
        return $this->trigger(Event::MVC, $args);
    }
}
