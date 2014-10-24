<?php

namespace Framework\Route\Match;

use Framework\Event\Event;
use Framework\Event\Base;
use Framework\Service\Resolver\Signal;
use Framework\Route\Definition\Definition;
use Framework\Route\Route;

class Match
    implements Event, RouteMatch
{
    /**
     *
     */
    use Base;
    use Signal;

    /**
     *
     */
    const EVENT = self::ROUTE;

    /**
     * @var Definition
     */
    protected $definition;

    /**
     * @var Route
     */
    protected $route;

    /***
     * @param Definition $definition
     * @param Route $route
     */
    public function __construct(Definition $definition, Route $route)
    {
        $this->definition = $definition;
        $this->route      = $route;
    }

    /**
     * @return array
     */
    protected function args()
    {
        return [
            Args::EVENT      => $this,
            Args::DEFINITION => $this->definition,
            Args::ROUTE      => $this->route,
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

        if (!$result) {
            $this->stop();
        }

        if ($result instanceof Route) {
            $this->route = $result;
        }

        return $result;
    }
}
