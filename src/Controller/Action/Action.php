<?php

namespace Framework\Controller\Action;

use Framework\Event\EventInterface;
use Framework\Event\EventTrait as Event;
use Framework\Service\Resolver\SignalTrait as Signal;

class Action
    implements EventInterface, ActionInterface
{
    /**
     *
     */
    use Event;
    use Signal;

    /**
     *
     */
    const EVENT = self::ACTION;

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
            Args::EVENT      => $this,
            Args::CONTROLLER => $this->controller,
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
