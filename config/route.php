<?php
/**
 *
 */

use Framework\Event\Config\Events;
use Framework\Route\Definition\RouteDefinition;
use Framework\Service\Config\Invokable\Invokable;
use Framework\Service\Config\Service\Service;

return [
    'definitions' => new RouteDefinition([
        'children' => [
            'error' => new RouteDefinition([
                'name'       => 'error',
                'route'      => '/error',
                'controller' => 'Controller\Error',
                'regex'      => '/error',
                'tokens'     => [['literal', '/error']]
            ])
        ]
    ]),
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
            PHP_INT_MAX => [new Invokable(new Service('Route\Error'))]
        ]
    ])
];
