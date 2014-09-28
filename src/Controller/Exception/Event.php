<?php

namespace Framework\Controller\Exception;

use Exception;
use Framework\Event\EventTrait as EventTrait;

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
     * @return Exception
     */
    public function exception()
    {
        return $this->exception;
    }

    /**
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    public function __invoke(callable $listener, array $options = [])
    {
        return $listener($this, $options[self::REQUEST], $options[self::RESPONSE]);
    }
}
