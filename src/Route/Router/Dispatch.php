<?php

namespace Framework\Route\Router;

use Framework\Event\Base;
use Framework\Event\Event;
use Framework\Service\Resolver\Signal;
use Framework\Route\Route;

class Dispatch
    implements Event, RouteDispatch
{
    /**
     *
     */
    use Base;
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
     * @param callable $callable
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function __invoke(callable $callable, array $args = [], callable $callback = null)
    {
        $result = $this->signal($callable, $this->args() + $args, $callback);

        if ($result && $result instanceof Route) {
            $this->stop();
        }

        return $result;
    }
}
