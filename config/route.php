<?php
/**
 *
 */

use Framework\Event\Config\Events;
use Framework\Route\Definition\RouteDefinition;
use Framework\Service\Config\Invokable\Invokable;
use Framework\Service\Config\ServiceConfig\ServiceConfig;

return [
    'definitions' => new RouteDefinition,
    'events' => new Events([
        'Route\Match' => [
            [
                'Route\Match\Scheme',
                'Route\Match\Hostname',
                'Route\Match\Path',
                'Route\Match\Wildcard',
                'Route\Match\Method'
            ]
        ],
        'Route\Dispatch' => [
            -1          => ['Route\Dispatch\Filter'],
            PHP_INT_MAX => [new Invokable(new ServiceConfig('Route\Error'))]
        ]
    ])
];
