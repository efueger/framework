<?php

namespace Framework\Controller\Exception;

use Exception;
use Framework\Event\Event;
use Framework\Event\Base;
use Framework\Service\Resolver\Signal;

class Dispatch
    implements DispatchException, Event
{
    /**
     *
     */
    const EVENT = self::EXCEPTION;

    /**
     *
     */
    use Base;
    use Signal;

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
