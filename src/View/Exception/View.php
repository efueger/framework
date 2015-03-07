<?php
/**
 *
 */

namespace Mvc5\View\Exception;

use Exception;
use Mvc5\Event\Event;
use Mvc5\Service\Resolver\EventSignal;
use Mvc5\View\ViewModel;

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
