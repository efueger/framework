<?php

namespace Framework\Response\Exception;

use Exception as ExceptionInterface;
use Framework\Event\Base;
use Framework\Event\Event;
use Framework\Response\Response;
use Framework\Service\Resolver\Signal;

class Exception
    implements ResponseException, Event
{
    /**
     *
     */
    use Base;
    use Signal;

    /**
     *
     */
    const EVENT = self::EXCEPTION;

    /**
     * @var ExceptionInterface
     */
    protected $exception;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @param ExceptionInterface $exception
     */
    public function __construct(ExceptionInterface $exception)
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
            Args::EXCEPTION => $this->exception,
            Args::RESPONSE  => $this->response,
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
        $response = $this->signal($callable, $this->args() + $args, $callback);

        $response instanceof Response && $this->response = $response;

        return $response;
    }
}
