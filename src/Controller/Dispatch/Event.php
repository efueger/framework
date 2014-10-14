<?php

namespace Framework\Controller\Dispatch;

use Framework\Event\EventTrait;
use Framework\Event\Signal\SignalTrait;

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
     * @return array
     */
    protected function args()
    {
        return [
            ArgsInterface::EVENT      => $this,
            ArgsInterface::CONTROLLER => $this->controller
        ];
    }

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    public function __invoke(callable $listener, array $args = [])
    {
        return $this->signal($listener, $this->args() + $args);
    }
}
