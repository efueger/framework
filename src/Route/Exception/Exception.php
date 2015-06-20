<?php
/**
 *
 */

namespace Mvc5\Route\Exception;

use Mvc5\Event\Event;
use Mvc5\Service\Resolver\EventSignal;
use Mvc5\Route\Route;

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
     * @param RouteException $route
     */
    public function __construct(RouteException $route)
    {
        $this->exception = $route[RouteException::EXCEPTION];
        $this->route     = $route[RouteException::ROUTE];
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
