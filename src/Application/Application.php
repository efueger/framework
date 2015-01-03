<?php
/**
 *
 */

namespace Framework\Application;

use Framework\Event\Manager\EventManager;
use Framework\Service\Manager\ServiceManager;

interface Application
    extends EventManager, ServiceManager
{
}
