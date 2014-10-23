<?php

namespace Framework\Controller\Dispatch;

use Framework\Event\Event;
use Framework\Event\Base;
use Framework\Service\Resolver\Signal;

class Dispatch
    implements Event, ControllerDispatch
{
    /**
     *
     */
    use Base;
    use Signal;

    /**
     *
     */
    const EVENT = self::CONTROLLER;

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
