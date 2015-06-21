<?php
/**
 *
 */

namespace Mvc5\Route\Exception;

use Mvc5\Event\Event;
use Mvc5\Route\Route;
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
     * @var Route
     */
    protected $route;

    /**
     * @param Route $route
     * @param \Exception $exception
     */
    public function __construct(Route $route, \Exception $exception)
    {
        $this->exception = $exception;
        $this->route     = $route;
    }

    /**
     * @return array
     */
    protected function args()
    {
        return [
            Args::EVENT     => $this,
            Args::EXCEPTION => $this->exception,
            Args::ROUTE     => $this->route
        ];
    }
}
