<?php

namespace Framework\Route;

trait RouteService
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