<?php
/**
 *
 */

use Mvc5\Service\Config\Dependency\Dependency;
use Mvc5\Service\Config\Service\Service;

return [
    'config'          => new Dependency('Config'),
    'layout'          => new Dependency('Layout'),
    'request'         => new Dependency('Request'),
    'response'        => new Dependency('Response'),
    'route:create'    => new Dependency('Route\Create'),
    'route:exception' => new Service('Route\Exception\Create'),
    'sm'              => new Dependency('Service\Manager'),
    'url'             => new Dependency('Route\Plugin'),
    'web'             => new Service('Mvc'),
    'vm'              => new Dependency('View\Manager')
];
