<?php

namespace Framework\Response;

use Framework\Event\EventInterface as Base;
use Framework\Event\EventTrait;
use Framework\Event\Signal\SignalTrait;

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
    const EVENT = self::RESPONSE;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return array
     */
    protected function args()
    {
        return [
            ArgsInterface::EVENT    => $this,
            ArgsInterface::RESPONSE => $this->response
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
