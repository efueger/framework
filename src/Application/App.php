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
     * @param array|Configuration $config
     */
    public function __construct($config)
    {
        $this->alias    = $config[Args::ALIAS];
        $this->config   = $config;
        $this->events   = $config[Args::EVENTS];
        $this->services = $config[Args::SERVICES];
    }
}
