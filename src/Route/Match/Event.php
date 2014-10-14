<?php

namespace Framework\Route\Match;

use Framework\Event\EventTrait as EventTrait;
use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Route\RouteInterface as Route;

class Event
    implements EventInterface
{
    /**
     *
     */
    use EventTrait;

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
     * @return Definition
     */
    public function definition()
    {
        return $this->definition;
    }

    /**
     * @return Route
     */
    public function route()
    {
        return $this->route;
    }

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    public function __invoke(callable $listener, array $args = [])
    {
        $result = $listener($this, $args);

        if (!$result) {
            $this->stop();
        }

        if ($result instanceof Route) {
            $this->route = $result;
        }

        return $result;
    }
}
