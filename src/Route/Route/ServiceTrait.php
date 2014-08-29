<?php

namespace Framework\Route\Route;

trait ServiceTrait
{
    /**
     * @var RouteInterface
     */
    protected $route;

    /**
     * @return null|RouteInterface
     */
    public function route()
    {
        return $this->route;
    }

    /**
     * @param RouteInterface $route
     * @return self
     */
    public function setRoute(RouteInterface $route)
    {
        $this->route = $route;
    }
}
