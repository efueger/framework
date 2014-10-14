<?php

namespace Framework\Route\Match;

use Framework\Event\EventTrait as EventTrait;
use Framework\Event\Signal\SignalTrait as SignalTrait;
use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

class Event
    implements EventInterface
{
    /**
     *
     */
    use EventTrait;
    use SignalTrait;

    /**
     *
     */
    const EVENT = self::MATCH;

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
            ArgsInterface::EVENT      => $this,
            ArgsInterface::DEFINITION => $this->definition,
            ArgsInterface::ROUTE      => $this->route,
        ];
    }

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    public function __invoke(callable $listener, array $args = [])
    {
        $result = $this->signal($listener, $this->args() + $args);

        if (!$result) {
            $this->stop();
        }

        if ($result instanceof Route) {
            $this->route = $result;
        }

        return $result;
    }
}
