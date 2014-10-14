<?php

namespace Framework\Controller\Exception;

use Exception;
use Framework\Event\EventTrait;
use Framework\Event\Signal\SignalTrait;

class Event
    implements EventInterface
{
    /**
     *
     */
    const EVENT = self::EXCEPTION;

    /**
     *
     */
    use EventTrait;
    use SignalTrait;

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
            ArgsInterface::EVENT     => $this,
            ArgsInterface::EXCEPTION => $this->exception
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
