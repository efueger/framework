<?php
/**
 *
 */

namespace Framework\Response\Dispatch;

use Framework\Event\Event;
use Framework\Response\Response;
use Framework\Service\Resolver\EventSignal;

class Dispatch
    implements DispatchResponse, Event
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
}
