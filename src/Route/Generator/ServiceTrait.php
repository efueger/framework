<?php

namespace Framework\Route\Generator;

trait ServiceTrait
{
    /**
     * @var RouteGenerator
     */
    protected $generator;

    /**
     * @param RouteGenerator $generator
     */
    public function setRouteGenerator(RouteGenerator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @param string $name
     * @param array $args
     * @return string
     */
    public function generate($name, array $args = [])
    {
        return $this->generator->url($name, $args);
    }
}
