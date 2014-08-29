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
     * @param array $options
     * @return string
     */
    public function generate($name, array $params = [], array $options = [])
    {
        return $this->generator->url($name, $params, $options);
    }
}
