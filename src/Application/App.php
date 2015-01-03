<?php
/**
 *
 */

namespace Framework\Application;

use Framework\Config\Configuration;
use Framework\Event\Manager\Events;

class App
    implements Application
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
        $this->alias    = $config->get(Args::ALIAS);
        $this->config   = $config;
        $this->events   = $config->get(Args::EVENTS);
        $this->services = $config->get(Args::SERVICES);
    }
}
