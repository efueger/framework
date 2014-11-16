<?php

namespace Framework\Application;

use Framework\Event\Manager\EventManager;
use Framework\Service\Manager\ServiceManager;

interface Application
    extends EventManager, ServiceManager
{
    /**
     *
     */
    const ALIAS = 'alias';

    /**
     *
     */
    const EVENTS = 'events';

    /**
     *
     */
    const SERVICES = 'services';
}
