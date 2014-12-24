<?php

namespace Framework\Controller\Dispatch;

use Framework\Event\Event;
use Framework\Service\Resolver\EventSignal;

class Dispatch
    implements Controller, Event
{
    /**
     *
     */
    use EventSignal;

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
            Args::EVENT      => $this,
            Args::CONTROLLER => $this->controller
        ];
    }
}
