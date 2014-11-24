<?php
/**
 *
 */

use Framework\Service\Config\Dependency\Dependency;
use Framework\Service\Config\Invoke\Invoke;
use Framework\Service\Config\Service\Service;

return [
    'config'        => new Dependency('Config'),
    'layout'        => new Dependency('Layout'),
    'request'       => new Dependency('Request'),
    'response'      => new Dependency('Response'),
    'url'           => new Dependency('Route\Generator\Plugin'),
    'web'           => new Service('Mvc'),
    'sm'            => new Dependency('Service\Manager'),
    'vm'            => new Dependency('View\Manager'),
    'route:builder' => new Dependency('Route\Builder'),
    'route:create'  => new Invoke('Route\Builder')
];
