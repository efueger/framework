<?php

namespace Framework\Route\Generator;

use Exception;
use Framework\Route\Definition\Builder\DefinitionBuilder as Route;
use Framework\Route\Definition\Definition;
use InvalidArgumentException;

/**
 * Portions copyright (c) 2013 Ben Scholzen 'DASPRiD'. (http://github.com/DASPRiD/Dash)
 * under the Simplified BSD License (http://opensource.org/licenses/BSD-2-Clause).
 */
class Generator
    implements RouteGenerator
{
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
     * @param $tokens
     * @param $args
     * @param $defaults
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function compile($tokens, $args, $defaults)
    {
        $stack = [];

        $current = [
            'is_optional' => false,
            'skip'        => true,
            'skippable'   => false,
            'path'        => '',
        ];

        foreach($tokens as $part) {
            switch($part[Route::TYPE]) {
                case 'literal':

                    $current['path'] .= $part[Route::LITERAL];

                    break;

                case 'parameter':

                    $current['skippable'] = true;

                    if (!isset($args[$part[Route::NAME]])) {

                        if (!$current['is_optional']) {
                            throw new InvalidArgumentException(sprintf('Missing parameter "%s"', $part[Route::NAME]));
                        }

                        continue;

                    } elseif (

                        !$current['is_optional']
                                || !isset($defaults[$part[Route::NAME]])
                                    || $defaults[$part[Route::NAME]] !== $args[$part[Route::NAME]]

                    ) {

                        $current['skip'] = false;

                    }

                    $current['path'] .= $args[$part[Route::NAME]];

                    break;

                case 'optional-start':

                    $stack[] = $current;

                    $current = [
                        'is_optional' => true,
                        'skip'        => true,
                        'skippable'   => false,
                        'path'        => '',
                    ];

                    break;

                case 'optional-end':

                    $parent = array_pop($stack);

                    if (

                        !($current['path'] !== '' && $current['is_optional'] && $current['skippable'] && $current['skip'])

                    ) {
                        $parent['path'] .= $current['path'];
                        $parent['skip'] = false;
                    }

                    $current = $parent;

                    break;
            }
        }

        return $current['path'];
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
     * @return array|Definition
     */
    protected function create($definition)
    {
        return $definition instanceof Definition && !empty($definition[Definition::REGEX]) ? $definition
            : ($this->callback ? call_user_func($this->callback, [$definition]) : null);
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
