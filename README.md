This php framework is an enhanced programming environment that uses events, named arguments and an optional configuration that provides further inversion of control of the application. The [configuration array](https://github.com/mvc5/application/blob/master/config/service.php) can contain values, string names, callables and configuration objects that are resolved by the service manager.

This contrived example demonstrates named arguments and plugins.
```php
$web = new App(include __DIR__ . '/../config/web.php');

$response = $web->call(
    'Controller.valid.add.response', 
    ['date_created' => time(), 'strict' => true]
);

var_dump($response instanceof Response);
```
The application is instantiated and a call is made to the `valid` method of the `Controller` class with its parameters resolved from either the array of arguments explicitly passed to the [`call`](https://github.com/mvc5/framework/blob/master/src/Service/Resolver/Resolver.php#L58) method or by the [`call`](https://github.com/mvc5/framework/blob/master/src/Service/Resolver/Resolver.php#L58) method retrieving a plugin with the same name as the parameter. Methods can be chained together and each will have their parameters resolved similarly.

```php
class Controller
{
    protected $blog;

    function valid(Request $request, $strict)
    {
        var_dump($strict);

        return $this;
    }

    function add(Response $response, $date_created)
    {
        var_dump($date_created);

        $this->blog = new Blog;

        return $this;
    }

    function response(ViewManager $vm, Response $response, $args)
    {
        var_dump($this->blog, $args);
        return $response;
    }
}
```
The output of the above is
```php
boolean true

int 1414690433

object(Blog\Blog)[100]

array (size=2)
  'date_created' => int 1414690433
  'strict' => boolean true

boolean true
```
The named argument `$args` is special and can be added to the method being called by the [`call`](https://github.com/mvc5/framework/blob/master/src/Service/Resolver/Resolver.php#L58) function and it provides an array of the named arguments.

To manage all of the parameters an optional callback can be added to call method, e.g
```php
$response = $web->call(
    'Controller.valid.add.response', 
    [], 
    function($name) { return new $name; }
);
```
##Events
Events can be strings or classes that can manage the arguments used for the methods being invoked for that event.
```php
class Event
{
  function args()
  {
    return [
        Args::EVENT      => $this,
        Args::RESPONSE   => $this->response(),
        Args::ROUTE      => $this->route(),
        Args::VIEW_MODEL => $this->viewModel(),
        Args::CONTROLLER => $this->route()->controller()
    ];
  }
  
  function __invoke(callable $listener, array $args = [], callable $callback = null)
  {
      return $this->signal($listener, $this->args() + $args, $callback);
  }
}
```
The `$callback` is used to provide the additional parameters not in the `$args` array and is provided by the service manager as `$this` or any callable type.
```php
$this->trigger([Dispatch::CONTROLLER, $controller], $args, $this);
```
##Plugins and Aliases
The parameter names of these additional arguments can be aliases or service names. An alias maps a string of varying characters excluding the call separator `.` to any positive value. If the value is a configuration object then it will be resolved and its value returned.

Plugins can be used in different ways, e.g to provide values, to trigger an event, or to call a service method. So each configuration is specific to their intended use.
```php
return [
    'blog:create' => new Service('Blog\Create'),
    'blog:valid'  => new Invoke('Blog\Controller.valid'),
    'config'      => new Dependency('Config'),
    'layout'      => new Dependency('Layout'),
    'request'     => new Dependency('Request'),
    'sm'          => new Dependency('Service\Manager'),
    'response'    => new Dependency('Response'),
    'pathinfo'    => new Call('request.getPathInfo'),
    'url'         => new Dependency('Route\Generator\Plugin'),
    'web'         => new Service('Mvc')
];
```
The [`plugin`](https://github.com/mvc5/framework/blob/master/src/Service/Manager/ManageService.php#L63) method is also used when calling an object.
```php
//trigger create blog event
$this->call('blog:create');

//call the controller's valid method with supporting arguments
$this->call('blog:valid');

function valid(Config $config, Request $request);
```
Which means invoking a web application is no different to calling any other method, e.g 
```php
$app = new Application($config);

$app->call('web'); //invoke web application (event)
```
And
```php
$app = new Application($config);

$app->call('request.getHost'); //get string hostname from the request object.

```
And with named arguments
```php
$app->call(
  'Blog\Controller.valid', 
  ['config' => $config, 'request' => $request]
);
```
To get all of the available arguments that are not plugin arguments, add `$args` to the method signature
```php
public function __invoke(Config $config, ViewManager $vm, array $args = [])
{
    var_dump($args);
}
```
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
    'alias' => [
        'web' => 'Mvc',
    ],
    'events'      => new Events(include __DIR__ . '/event.php'),
    'services'    => new Container(include __DIR__ . '/service.php'),
    'routes'      => include __DIR__ . '/route.php',
    'translator'  => include __DIR__ . '/i18n.php',
    'view'        => include __DIR__ . '/view.php'
]);
```
```php
call_user_func(new Web(include __DIR__ . '/../config/web.php'));

// or 
// (new App($config))->call('web');
```
Microframeworks can be built similar to this [gist](https://gist.github.com/devosc/5b66b7080a6736d8d9d5).
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
The [configuration](https://github.com/mvc5/application/blob/master/config/service.php) of the [`Service Container`](https://github.com/mvc5/framework/blob/master/src/Service/Container/ServiceContainer.php) is an array containing values, string names, `callable` types and configuration objects.
##Routes
Routes are pre-compiled so that they can be immediately matched against the request's uri path. Other aspects of the request and route can also be matched, e.g. scheme, hostname, method, wildcard. See the <a href="https://github.com/mvc5/application/blob/master/config/route.php">route config</a> for example child routes.
```php
'home' => new Definition([
  'name'        => 'home',
  'scheme'      => null,
  'hostname'    => null,
  'method'      => null,
  'route'       => '/',
  'defaults'    => [],
  'controller'  => 'Home',
  'paramMap'    => [],
  'regex'       => '/',
  'tokens'      => [['literal', '/']],
  'constraints' => []
])
```
##Event Configuration
Events and listeners are <a href="https://github.com/mvc5/application/blob/master/config/event.php">configurable</a> and support various types of configuration that must resolve to being a `callable` type.
```php
'Mvc' => [
    ['Mvc\Route'],
    ['Mvc\Dispatch'],
    ['Mvc\Layout'],
    ['Mvc\Render'],
    [function($event, $vm) { //named args
        var_dump(__FILE__, $event, $vm);
    }],
    ['Mvc\Response']
]
```
