<?php
/**
 *
 */

use Framework\Service\Config\Dependency\Dependency;
use Framework\Service\Config\Service\Service;

return [
    'config'       => new Dependency('Config'),
    'layout'       => new Dependency('Layout'),
    'request'      => new Dependency('Request'),
    'response'     => new Dependency('Response'),
    'route:add'    => new Dependency('Route\Add'),
    'route:create' => new Dependency('Route\Create'),
    'sm'           => new Dependency('Service\Manager'),
    'url'          => new Dependency('Route\Plugin'),
    'web'          => new Service('Mvc'),
    'vm'           => new Dependency('View\Manager')
];
