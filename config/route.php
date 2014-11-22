<?php
/**
 *
 */

use Framework\Event\Config\Events;
use Framework\Route\Definition\RouteDefinition;
use Framework\Service\Config\Param\Param;
use Framework\Service\Config\Router\Router;

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
            PHP_INT_MAX => [new Router(new Param('routes.definitions.children.error'))]
        ]
    ])
];
