<?php

namespace Framework\Route\Generator;

trait ServiceTrait
{
    /**
     * @var GeneratorInterface
     */
    protected $generator;

    /**
     * @param GeneratorInterface $generator
     */
    public function setRouteGenerator(GeneratorInterface $generator)
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
