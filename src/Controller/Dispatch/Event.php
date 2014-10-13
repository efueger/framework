<?php

namespace Framework\Controller\Dispatch;

use Framework\Event\EventTrait as EventTrait;
use Framework\Event\Signal\SignalInterface;
use Framework\Event\Signal\SignalTrait;

class Event
    implements EventInterface, SignalInterface
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
        $options = [
            ArgsInterface::EVENT   => $this,
            ArgsInterface::OPTIONS => [ArgsInterface::EVENT => $this] + $options
        ] + $options;

        return $this->signal($listener, $options);
    }
}
