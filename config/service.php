<?php
/**
 *
 */

use Framework\Service\Config\Args\Args;
use Framework\Service\Config\Call\Call;
use Framework\Service\Config\Config;
use Framework\Service\Config\ConfigLink\ConfigLink;
use Framework\Service\Config\Dependency\Dependency;
use Framework\Service\Config\Hydrator\Hydrator;
use Framework\Service\Config\Invoke\Invoke;
use Framework\Service\Config\Invokable\Invokable;
use Framework\Service\Config\Manager\Manager;
use Framework\Service\Config\Param\Param;
use Framework\Service\Config\Service\Service;
use Framework\Service\Config\ServiceConfig\ServiceConfig;
use Framework\Service\Config\ServiceManagerLink\ServiceManagerLink;

return [
    'Config'                => new ConfigLink,
    'Controller\Action'     => Framework\Controller\Action\Action::class,
    'Controller\Dispatch'   => Framework\Controller\Dispatch\Dispatch::class,
    'Controller\Dispatcher' => new Hydrator(
        Framework\Controller\Dispatch\Dispatcher::class,
        ['setControllerManager' => new Dependency('Controller\Manager')]
    ),
    'Controller\Error' => new Hydrator(
        Framework\Controller\Error\Controller::class,
        [
            'setModel' => new Service(
                Framework\Controller\Error\Model::class,
                ['error/404', ['message' => 'A 404 error occurred']]
            )
        ]
    ),
    'Controller\Exception' => Framework\Controller\Exception\Dispatch::class,
    'Controller\Exception\Controller' => new Hydrator(
        Framework\Controller\Exception\Controller::class,
        ['setModel' => new Dependency('Exception\Model')]
    ),
    'Controller\Manager' => new Manager(Framework\Controller\Manager\Manager::class),
    'Exception\Renderer' => new Hydrator(
        Framework\View\Exception\Renderer::class,
        ['setViewManager' => new Dependency('View\Manager')]
    ),
    'Exception\View' => new Hydrator(
        Framework\View\Exception\View::class,
        ['setModel' => new Dependency('Exception\Model')]
    ),
    'Exception\Model' => new Service(Framework\View\Exception\Model::class, ['error/exception']),
    'Factory' => new Config(['args' => [new ServiceManagerLink]]),
    'Layout'  => new Service(Framework\View\Layout\Model::class, ['layout']),
    'Manager' => new Hydrator(null, [
        'aliases'       => new Param('alias'),
        'configuration' => new ConfigLink,
        'events'        => new Param('events'),
        'services'      => new Param('services'),
    ]),
    'Mvc' => new Service(Framework\Mvc\Mvc::class, [new ServiceManagerLink]),
    'Mvc\Controller' => new Hydrator(
        Framework\Mvc\Controller\Dispatcher::class,
        ['setControllerManager' => new Dependency('Controller\Manager')]
    ),
    'Mvc\Layout' => Framework\Mvc\Layout\Renderer::class,
    'Mvc\Response' => new Hydrator(
        Framework\Mvc\Response\Dispatcher::class,
        ['setResponseManager' => new Dependency('Response\Manager')]
    ),
    'Mvc\Route' => new Hydrator(
        Framework\Mvc\Route\Router::class,
        ['setRouteManager' => new Dependency('Route\Manager')]
    ),
    'Mvc\View' => new Hydrator(
        Framework\Mvc\View\Renderer::class,
        ['setViewManager' => new Dependency('View\Manager')]
    ),
    'Response\Dispatch'  => Framework\Response\Dispatch::class,
    'Response\Exception' => Framework\Response\Exception\Exception::class,
    'Response\Exception\Dispatch' => new Service(
        Framework\Response\Exception\Dispatcher::class,
        [new Hydrator('Response', ['setStatus' => 500])]
    ),
    'Response\Exception\Renderer' => Framework\Response\Exception\Renderer::class,
    'Response\Sender'             => Framework\Response\Sender::class,
    'Response\Manager'            => new Manager(Framework\Response\Manager\Manager::class),
    'Route' => new Service(
        Framework\Route\Config::class,
        [
            new Args([
                'hostname' => new Call('request.getHost'),
                'method'   => new Call('request.getMethod'),
                'path'     => new Call('request.getPathInfo'),
                'scheme'   => new Call('request.getScheme')
            ])
        ]
    ),
    'Route\Builder' => new Service(
        Framework\Route\Definition\Builder\Builder::class,
        [new Param('routes')]
    ),
    'Route\Dispatch'        => Framework\Route\Router\Dispatch::class,
    'Route\Dispatch\Error'  => new Invokable(new ServiceConfig('Route\Error')),
    'Route\Dispatch\Filter' => Framework\Route\Router\Filter::class,
    'Route\Error' => new Service(
        'Route',
        [
            new Args([
                'controller' => 'Controller\Error',
                'hostname'   => new Call('request.getHost'),
                'method'     => new Call('request.getMethod'),
                'name'       => 'error',
                'path'       => new Call('request.getPathInfo'),
                'scheme'     => new Call('request.getScheme')
            ])
        ]
    ),
    'Route\Generator' => new Service(
        Framework\Route\Generator\Generator::class,
        [new Param('routes'), new Invoke('Route\Builder')]
    ),
    'Route\Manager'        => new Manager(Framework\Route\Manager\Manager::class),
    'Route\Match'          => Framework\Route\Match\Match::class,
    'Route\Match\Hostname' => Framework\Route\Match\Hostname\Hostname::class,
    'Route\Match\Method'   => Framework\Route\Match\Method\Method::class,
    'Route\Match\Path'     => Framework\Route\Match\Path\Path::class,
    'Route\Match\Scheme'   => Framework\Route\Match\Scheme\Scheme::class,
    'Route\Match\Wildcard' => Framework\Route\Match\Wildcard\Wildcard::class,
    'Route\Plugin' => new Hydrator(
        Framework\Route\Generator\GeneratorPlugin::class,
        [
            'setRoute'          => new Dependency('Route'),
            'setRouteGenerator' => new Dependency('Route\Generator')
        ]
    ),
    'Router' => new Service(
        Framework\Route\Router\Router::class,
        [new Param('routes')],
        ['setRouteManager' => new Dependency('Route\Manager')]
    ),
    'Service\Manager' => new ServiceManagerLink,
    'View\Manager'    => new Manager(Framework\View\Manager\Manager::class),
    'View\Model'      => Framework\View\Model\Model::class,
    'View\Render'     => Framework\View\Render\Render::class,
    'View\Renderer'   => new Hydrator(
        Framework\View\Renderer\Renderer::class,
        [
            'templates'      => new Param('templates'),
            'setViewManager' => new Dependency('View\Manager')
        ]
    )
];
