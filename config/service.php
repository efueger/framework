<?php
/**
 *
 */

namespace Mvc5;

use Mvc5\Service\Config\Args\Args;
use Mvc5\Service\Config\Call\Call;
use Mvc5\Service\Config\ConfigLink\ConfigLink;
use Mvc5\Service\Config\Dependency\Dependency;
use Mvc5\Service\Config\Hydrator\Hydrator;
use Mvc5\Service\Config\Invokable\Invokable;
use Mvc5\Service\Config\Manager\Manager;
use Mvc5\Service\Config\Param\Param;
use Mvc5\Service\Config\Service\Service;
use Mvc5\Service\Config\ServiceConfig\ServiceConfig;
use Mvc5\Service\Config\ServiceManagerLink\ServiceManagerLink;

return [
    'Config'                => new ConfigLink,
    'Controller\Action'     => Controller\Action\Action::class,
    'Controller\Dispatch'   => Controller\Dispatch\Dispatch::class,
    'Controller\Dispatcher' => new Hydrator(
        Controller\Dispatch\Dispatcher::class,
        ['setControllerManager' => new Dependency('Controller\Manager')]
    ),
    'Controller\Error' => new Hydrator(
        Controller\Error\Controller::class,
        [
            'setModel' => new Service(
                Controller\Error\Model::class,
                ['error/404', ['message' => 'A 404 error occurred']]
            )
        ]
    ),
    'Controller\Exception' => Controller\Exception\Exception::class,
    'Controller\Exception\Controller' => new Hydrator(
        Controller\Exception\Controller::class,
        ['setModel' => new Dependency('Exception\Model')]
    ),
    'Controller\Manager' => new Manager(Controller\Manager\Manager::class),
    'Exception\Renderer' => new Hydrator(
        View\Exception\Renderer::class,
        ['setViewManager' => new Dependency('View\Manager')]
    ),
    'Exception\View' => new Hydrator(
        View\Exception\View::class,
        ['setModel' => new Dependency('Exception\Model')]
    ),
    'Exception\Model' => new Service(View\Exception\Model::class, ['error/exception']),
    'Factory' => new Service(null, [new ServiceManagerLink]),
    'Layout'  => new Service(View\Layout\Model::class, ['layout']),
    'Manager' => new Hydrator(null, [
        'aliases'       => new Param('alias'),
        'configuration' => new ConfigLink,
        'events'        => new Param('events'),
        'services'      => new Param('services'),
    ]),
    'Mvc' => new Service(Mvc\Mvc::class, [new ServiceManagerLink]),
    'Mvc\Controller' => new Hydrator(
        Mvc\Controller\Dispatcher::class,
        ['setControllerManager' => new Dependency('Controller\Manager')]
    ),
    'Mvc\Layout' => Mvc\Layout\Renderer::class,
    'Mvc\Response' => new Hydrator(
        Mvc\Response\Dispatcher::class,
        ['setResponseManager' => new Dependency('Response\Manager')]
    ),
    'Mvc\Route' => new Hydrator(
        Mvc\Route\Router::class,
        ['setRouteManager' => new Dependency('Route\Manager')]
    ),
    'Mvc\View' => new Hydrator(
        Mvc\View\Renderer::class,
        ['setViewManager' => new Dependency('View\Manager')]
    ),
    'Response\Dispatch'  => Response\Dispatch\Dispatch::class,
    'Response\Exception' => Response\Exception\Exception::class,
    'Response\Exception\Dispatch' => new Service(
        Response\Exception\Dispatcher::class,
        [new Hydrator('Response', ['setStatus' => 500])]
    ),
    'Response\Exception\Renderer' => Response\Exception\Renderer::class,
    'Response\Sender'             => Response\Send\Sender::class,
    'Response\Manager'            => new Manager(Response\Manager\Manager::class),
    'Route' => new Service(
        Route\Config::class,
        [
            new Args([
                'hostname' => new Call('request.getHost'),
                'method'   => new Call('request.getMethod'),
                'path'     => new Call('request.getPathInfo'),
                'scheme'   => new Call('request.getScheme')
            ])
        ]
    ),
    'Route\Builder'  => Route\Builder\Builder::class,
    'Route\Create'   => Route\Builder\Create::class,
    'Route\Dispatch' => Route\Router\Dispatch::class,
    'Route\Error'    => new Invokable(new ServiceConfig('Route\Error\Route')),
    'Route\Error\Route' => new Service(
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
    'Route\Exception'        => new Service(Route\Exception\Exception::class, [new Dependency('Route')]),
    'Route\Exception\Create' => new Service(Route\Exception\Create::class, [new Service('Route\Exception\Route')]),
    'Route\Exception\Route'  => new Service(
        Route\Exception\Config::class,
        [
            new Args([
                'controller' => 'Route\Exception',
                'hostname'   => new Call('request.getHost'),
                'method'     => new Call('request.getMethod'),
                'name'       => 'exception',
                'path'       => new Call('request.getPathInfo'),
                'scheme'     => new Call('request.getScheme')
            ])
        ]
    ),
    'Route\Exception\Controller' => new Service('Controller\Exception\Controller'),
    'Route\Filter' => Route\Filter\Filter::class,
    'Route\Generator' => new Service(
        Route\Generator\Generator::class,
        [new Param('routes'), new Dependency('Route\Builder')]
    ),
    'Route\Manager'        => new Manager(Route\Manager\Manager::class),
    'Route\Match'          => Route\Match\Match::class,
    'Route\Match\Hostname' => Route\Match\Hostname\Hostname::class,
    'Route\Match\Method'   => Route\Match\Method\Method::class,
    'Route\Match\Path'     => Route\Match\Path\Path::class,
    'Route\Match\Scheme'   => Route\Match\Scheme\Scheme::class,
    'Route\Match\Wildcard' => Route\Match\Wildcard\Wildcard::class,
    'Route\Plugin' => new Hydrator(
        Route\Plugin\Plugin::class,
        [
            'setRoute'          => new Dependency('Route'),
            'setRouteGenerator' => new Dependency('Route\Generator')
        ]
    ),
    'Router' => new Service(
        Route\Router\Router::class,
        [new Param('routes')],
        ['setRouteManager' => new Dependency('Route\Manager')]
    ),
    'Service\Manager' => new ServiceManagerLink,
    'View\Manager'    => new Manager(View\Manager\Manager::class),
    'View\Model'      => View\Model\Model::class,
    'View\Render'     => View\Render\Render::class,
    'View\Renderer'   => new Hydrator(
        View\Renderer\Renderer::class,
        [
            'templates'      => new Param('templates'),
            'setViewManager' => new Dependency('View\Manager')
        ]
    )
];
