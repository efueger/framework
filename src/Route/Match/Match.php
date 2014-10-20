<?php

namespace Framework\Route\Match;

use Framework\Event\EventInterface;
use Framework\Event\EventTrait;
use Framework\Service\Resolver\SignalTrait;
use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\RouteInterface as Route;

class Match
    implements EventInterface, MatchInterface
{
    /**
     *
     */
    use EventTrait;
    use SignalTrait;

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
     * @param callable $listener
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    public function __invoke(callable $listener, array $args = [], callable $callback = null)
    {
        $result = $this->signal($listener, $this->args() + $args, $callback);

        if (!$result) {
            $this->stop();
        }

        if ($result instanceof Route) {
            $this->route = $result;
        }

        return $result;
    }
}
