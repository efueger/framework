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
    protected $config;

    /**
     * @param Definition $config
     * @param callable $callback
     */
    public function __construct(Definition $config, callable $callback = null)
    {
        $this->callback = $callback;
        $this->config   = $config;
    }

    /**
     * @param $name
     * @param array $args
     * @param Definition $definition
     * @return string|void
     * @throws Exception
     */
    protected function build($name, array $args = [], Definition $definition = null)
    {
        $names = explode('/', $name, 2);

        $definition = $definition ? $definition->child($names[0]) : $this->definition($names[0]);

        if (!$definition) {
            throw new Exception('Route generator definition not found: ' . $names[0]);
        }

        $url = $this->compile($definition->tokens(), $args, $definition->defaults());

        isset($names[1]) && $url .= $this->build($names[1], $args, $definition);

        if ($args && $definition->wildcard()) {
            foreach(array_diff_key($args, $definition->constraints()) as $key => $value) {
                $url .= '/' . $key . '/' . $value;
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
     * @param array|Definition $definition
     * @return array|Definition
     */
    protected function create($definition)
    {
        return $definition instanceof Definition ? $definition
            : ($this->callback ? call_user_func($this->callback, [$definition]) : null);
    }

    /**
     * @param $name
     * @return Definition
     */
    protected function definition($name)
    {
        return $this->create($this->config->child($name)) ?: $name;
    }

    /**
     * @param string $name
     * @param array $args
     * @return string
     */
    public function url($name, array $args = [])
    {
        return rtrim($this->build($name, $args), '/') ?: '/';
    }
}
