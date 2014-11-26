<?php
/**
 *
 */

use Framework\Config\Config;
use Framework\Service\Container\Container;
use Framework\Event\Config\Events;

return new Config([
    'alias'     => new Config(include __DIR__ . '/alias.php'),
    'events'    => new Events(include __DIR__ . '/event.php'),
    'services'  => new Container(include __DIR__ . '/service.php'),
    'templates' => new Config(include __DIR__ . '/templates.php')
]);
