<?php

namespace Framework\Controller\Exception;

use Exception;
use Framework\Event\Event;
use Framework\Service\Resolver\EventSignal;

class Dispatch
    implements DispatchException, Event
{
    /**
     *
     */
    use EventSignal;

    /**
     *
     */
    const EVENT = self::EXCEPTION;

    /**
     * @var Exception
     */
    protected $exception;

    /**
     * @param Exception $exception
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return array
     */
    protected function args()
    {
        return [
            Args::EVENT     => $this,
            Args::EXCEPTION => $this->exception
        ];
    }
}
