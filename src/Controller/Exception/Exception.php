<?php
/**
 *
 */

namespace Mvc5\Controller\Exception;

use Mvc5\Event\Event;
use Mvc5\Service\Resolver\EventSignal;

class Exception
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
     * @var \Exception
     */
    protected $exception;

    /**
     * @param \Exception $exception
     */
    public function __construct(\Exception $exception)
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
