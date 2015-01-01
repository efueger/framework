<?php

namespace Framework\Route\Generator;

use Exception;
use Framework\Route\Builder\Compiler;
use Framework\Route\Definition\Definition;

class Generator
    implements RouteGenerator
{
    /**
     *
     */
    use Compiler;

    /**
     * @var callable
     */
    protected $callback;

    /**
     * @var Definition
     */
    protected $definition;

    /**
     * @param Definition $definition
     * @param callable $callback
     */
    public function __construct(Definition $definition, callable $callback = null)
    {
        $this->callback   = $callback;
        $this->definition = $definition;
    }

    /**
     * @param array|string $name
     * @param array $args
     * @param Definition $definition
     * @return string|void
     * @throws Exception
     */
    protected function build($name, array $args = [], Definition $definition = null)
    {
        $name = is_array($name) ? $name : explode('/', $name);

        $definition = $definition ? $this->create($definition->child($name[0])) : $this->create($this->config($name[0]));

        if (!$definition) {
            throw new Exception('Route generator definition not found: ' . $name[0]);
        }

        array_shift($name);

        $url = $this->compile($definition->tokens(), $args, $definition->defaults());

        $name && $url .= $this->build($name, $args, $definition);

        if ($args && $definition->wildcard()) {
            foreach(array_diff_key($args, $definition->constraints()) as $key => $value) {
                null !== $value && $url .= '/' . $key . '/' . $value;
            }
        }

        return $url;
    }

    /**
     * @param $name
     * @return Definition
     */
    protected function config($name)
    {
        return $name === $this->definition->name() ? $this->definition : $this->definition->child($name);
    }

    /**
     * @param array|Definition $definition
     * @return Definition|null
     */
    protected function create($definition)
    {
        return $definition instanceof Definition && !empty($definition[Definition::REGEX]) ? $definition
            : ($this->callback ? call_user_func($this->callback, $definition) : null);
    }

    /**
     * @param string $name
     * @return string
     */
    protected function name($name)
    {
        return $name === $this->definition->name() ? $name : $this->definition->name() . '/' . $name;
    }

    /**
     * @param string $name
     * @param array $args
     * @return string
     */
    public function url($name, array $args = [])
    {
        return rtrim($this->build($this->name($name), $args), '/') ?: '/';
    }
}
