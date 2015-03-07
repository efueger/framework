<?php
/**
 *
 */

use Mvc5\Config\Config;
use Mvc5\Service\Container\Container;

return new Config([
    'alias'     => new Config(include __DIR__ . '/alias.php'),
    'events'    => new Config(include __DIR__ . '/event.php'),
    'services'  => new Container(include __DIR__ . '/service.php'),
    'templates' => new Config(include __DIR__ . '/templates.php')
]);
