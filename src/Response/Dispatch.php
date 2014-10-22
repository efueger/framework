<?php

namespace Framework\Response;

use Framework\Event\Event;
use Framework\Event\EventTrait;
use Framework\Service\Resolver\SignalTrait;

class Dispatch
    implements DispatchInterface, Event
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
            Args::EVENT    => $this,
            Args::RESPONSE => $this->response
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
