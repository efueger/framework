<?php

namespace Framework\Controller\Dispatch;

use Framework\Event\EventInterface as Base;
use Framework\Event\EventTrait;
use Framework\Service\Resolver\SignalTrait;

class Event
    implements Base, EventInterface
{
    /**
     *
     */
    use EventTrait;
    use SignalTrait;

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
            ArgsInterface::CONTROLLER => $this->controller,
        ];
    }

    /**
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function __invoke(callable $listener, array $args = [], callable $callback = null)
    {
        return $this->signal($listener, $this->args() + $args, $callback);
    }
}
