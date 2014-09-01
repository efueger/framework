This framework is an event management system that implements the architectual MVC pattern using events, listeners and dependency injection. It does not need to be boot strapped. Listeners closely follow the Single Responsibility Principle, they are SOLID and `callable`. Events manage their own state by signaling each listener and managing the response, this allows them to have different types of behaviors.

Usage
--
The <a href="https://github.com/mvc5/application">mvc5/application</a> demonstrates its usage as an MVC web application.

```php
include __DIR__ . '/../vendor/autoload.php';
```
```php
use Framework\Config\Config;
use Framework\Service\Container\Container;
use Framework\Event\Config\Config as Events;

$config = new Config([
    'controllers' => new Events(include __DIR__ . '/controller.php'),
    'events'      => new Events(include __DIR__ . '/event.php'),
    'services'    => new Container(include __DIR__ . '/service.php'),
    'routes'      => new Config(include __DIR__ . '/route.php'),
    'translator'  => new Config(include __DIR__ . '/i18n.php'),
    'view'        => new Config(include __DIR__ . '/view.php')
]);
```
```php
(new Application($config))->run();
```
##Benchmark
*Current*
```
HTML transferred:       4229135 bytes
Requests per second:    1290.86 [#/sec] (mean)
Time per request:       7.747 [ms] (mean)
Time per request:       0.775 [ms] (mean, across all concurrent requests)
```
*Other/Previous*
```
HTML transferred:       5502000 bytes
Requests per second:    315.78 [#/sec] (mean)
Time per request:       31.667 [ms] (mean)
Time per request:       3.167 [ms] (mean, across all concurrent requests)
```
##Dependency Injection
```php
'Route\Match\Wildcard' => Framework\Route\Match\Wildcard\Wildcard::class,
```
```php
'Route\Generator' => new Service(
  Framework\Route\Generator\Generator::class, 
  [new Param('routes.definitions')]
),
```
```php
'Controller\Manager' => new Hydrator(
    Framework\Controller\Manager\Manager::class,
    [
        'configuration' => new ConfigLink,
        'events'        => new Param('controllers'),
        'services'      => new Param('services')
    ]
),
```
```php
'Mvc\SendResponse' => new Hydrator(
  Framework\Mvc\SendResponse\Listener::class,
  [
    'setResponseManager' => new Dependency('Response\Manager')
  ]
),
```
The Dependency Injection <a href="https://github.com/mvc5/application/blob/master/config/service.php">Container</a> is an array containing the information about the services that it provides. Service configuration values can be string class names, `callable`, or configuration objects.
##Routes
Routes are pre-compiled so that they can be immediately matched against the request's uri path. Other aspects of the request and route can also be matched, e.g. scheme, hostname, method, wildcard. See the <a href="https://github.com/mvc5/application/blob/master/config/route.php">route config</a> for example child routes.
```php
'home' => new Definition([
  'name'       => 'home',
  'scheme'     => null,
  'hostname'   => null,
  'method'     => null,
  'route'      => '/',
  'defaults'   => [],
  'controller' => 'Home',
  'paramMap'   => [],
  'regex'      => '/',
  'tokens'     => [['literal', '/']]
])
```
##MVC
The MVC event workflow is completely <a href="https://github.com/mvc5/application/blob/master/config/event.php">configurable</a>.
```php
'Mvc\Event' => [
    ['Mvc\Route'],
    ['Mvc\Dispatch'],
    ['Mvc\Layout'],
    ['Mvc\Render'],
    ['Mvc\Response'],
    ['Mvc\SendResponse']
]
```
##Credits
* [Ben Scholzen 'DASPRiD'](http://github.com/DASPRiD) the [Router prototype for Zend Framework 3](https://github.com/DASPRiD/Dash)
* [Matthew Weier O'Phinney](https://github.com/weierophinney) introducing events to the [Zend Framework](https://github.com/zendframework)
* [Marco Pivetta](https://github.com/Ocramius) contributions and inspiration to the [Zend Framework](https://github.com/zendframework)
* [George Cooksey](https://github.com/texdc) knowledge of events
* [Michaël Gallego](https://github.com/bakura10) contributions and inspiration to the [Zend Framework](https://github.com/zendframework)
