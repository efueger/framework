<?php

namespace Framework\Controller\Dispatch;

use Framework\Event\EventTrait as EventTrait;
use Framework\Event\Signal\SignalTrait;
use Framework\Route\Route\RouteInterface as Route;

class Event
    implements EventInterface
{
    /**
     *
     */
    use EventTrait,
        SignalTrait;

    /**
     *
     */
    const EVENT = self::DISPATCH;

    /**
     * @var callable
     */
    protected $controller;

    /**
     * @param callable $controller
     */
    public function __construct(callable $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return callable|string
     */
    public function controller()
    {
        return $this->controller;
    }

    /**
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    public function __invoke(callable $listener, array $options = [])
    {
        return $this->signal($listener, ['event' => $this, 'options' => ['event' => $this] + $options] + $options);
    }
}
