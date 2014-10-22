<?php

namespace Framework\Route;

trait ServiceTrait
{
    /**
     * @var Route
     */
    protected $route;

    /**
     * @return null|Route
     */
    public function route()
    {
        return $this->route;
    }

    /**
     * @param Route $route
     * @return self
     */
    public function setRoute(Route $route)
    {
        $this->route = $route;
    }
}
