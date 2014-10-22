<?php

namespace Framework\Route\Router;

use Framework\Event\Event;
use Framework\Event\BaseEvent;
use Framework\Service\Resolver\Signal;
use Framework\Route\Route;

class Dispatch
    implements RouterDispatch, Event
{
    /**
     *
     */
    use BaseEvent;
    use Signal;

    /**
     *
     */
    const EVENT = self::DISPATCH;

    /**
     * @var Route $route
     */
    protected $route;

    /**
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * @return array
     */
    protected function args()
    {
        return [
            Args::EVENT => $this,
            Args::ROUTE => $this->route
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
        $result = $this->signal($listener, $this->args() + $args, $callback);

        if ($result && $result instanceof Route) {
            $this->stop();
        }

        return $result;
    }
}
