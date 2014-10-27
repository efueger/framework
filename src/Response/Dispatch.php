<?php

namespace Framework\Response;

use Framework\Event\Event;
use Framework\Event\Base;
use Framework\Service\Resolver\Signal;

class Dispatch
    implements DispatchResponse, Event
{
    /**
     *
     */
    use Base;
    use Signal;

    /**
     *
     */
    const EVENT = self::DISPATCH;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @param Response $response
     */
    public function __construct(Response $response)
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
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function __invoke(callable $callable, array $args = [], callable $callback = null)
    {
        return $this->signal($callable, $this->args() + $args, $callback);
    }
}
