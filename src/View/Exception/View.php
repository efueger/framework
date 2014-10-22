<?php

namespace Framework\View\Exception;

use Exception;
use Framework\Event\Event;
use Framework\Event\EventTrait;
use Framework\Service\Resolver\SignalTrait;
use Framework\View\Model\ServiceTrait as ViewModelTrait;

class View
    implements Event, ExceptionView
{
    /**
     *
     */
    use EventTrait;
    use SignalTrait;
    use ViewModelTrait;

    /**
     *
     */
    const EVENT = self::VIEW;

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
            Args::EVENT      => $this,
            Args::EXCEPTION  => $this->exception,
            Args::VIEW_MODEL => $this->viewModel()
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
