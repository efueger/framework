<?php

namespace Framework\View\Exception;

use Exception;
use Framework\Event\Event;
use Framework\Service\Resolver\EventSignal;
use Framework\View\ViewModel;

class View
    implements Event, ViewException
{
    /**
     *
     */
    use EventSignal;
    use ViewModel;

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
            Args::MODEL      => $this->model()
        ];
    }
}
