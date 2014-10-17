<?php

namespace Framework\Controller\Exception;

use Exception;
use Framework\Event\EventInterface as Base;
use Framework\Event\EventTrait;
use Framework\Service\Resolver\SignalTrait;

class Event
    implements Base, EventInterface
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
     * @param callable $callback
     * @return mixed
     */
    public function __invoke(callable $listener, array $args = [], callable $callback = null)
    {
        return $this->signal($listener, $this->args() + $args, $callback);
    }
}
