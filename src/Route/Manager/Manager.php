<?php

namespace Framework\Route\Manager;

use Framework\Event\Manager\EventManager;
use Framework\Service\Manager\ServiceManager;

class Manager
    implements EventManager, RouteManager, ServiceManager
{
    /**
     *
     */
    use Manage;
}
