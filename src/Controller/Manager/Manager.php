<?php

namespace Framework\Controller\Manager;

use Framework\Event\Manager\EventManager;
use Framework\Service\Manager\ServiceManager;

class Manager
    implements ControllerManager, EventManager, ServiceManager
{
    /**
     *
     */
    use Manage;
}
