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
     * @param array $params
     * @return string
     */
    public function generate($name, array $params = [])
    {
        return $this->generator->url($name, $params);
    }
}
