<?php

namespace Framework\Route\Generator;

use Framework\Config\ConfigInterface as Config;
use Framework\Route\Definition\DefinitionInterface as Definition;
use Framework\Route\Definition\Builder\BuilderInterface as Route;
use InvalidArgumentException;
use Exception;

/**
 * Portions copyright (c) 2013 Ben Scholzen 'DASPRiD'. (http://github.com/DASPRiD/Dash)
 * under the Simplified BSD License (http://opensource.org/licenses/BSD-2-Clause).
 */
class Generator
    implements GeneratorInterface
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param $name
     * @param array $params
     * @param Definition $definition
     * @return string|void
     * @throws Exception
     */
    protected function build($name, array $params = [], Definition $definition = null)
    {
        $names = explode('/', $name, 2);

        $definition = $definition ? $definition->child($names[0]) : $this->definition($names[0]);

        if (!$definition) {
            throw new Exception('Route generator definition not found: ' . $names[0]);
        }

        $url = $this->compile($definition->tokens(), $params, $definition->defaults());

        if (isset($names[1])) {
            $url .= $this->build($names[1], $params, $definition);
        }

        if ($params && $definition->wildcard()) {
            foreach(array_diff_key($params, $definition->constraints()) as $key => $value) {
                $url .= '/' . $key . '/' . $value;
            }
        }

        return $url;
    }

    /**
     * @param $tokens
     * @param $params
     * @param $defaults
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function compile($tokens, $params, $defaults)
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

                    if (!isset($params[$part[Route::NAME]])) {

                        if (!$current['is_optional']) {
                            throw new InvalidArgumentException(sprintf('Missing parameter "%s"', $part[Route::NAME]));
                        }

                        continue;

                    } elseif (

                        !$current['is_optional']
                                || !isset($defaults[$part[Route::NAME]])
                                    || $defaults[$part[Route::NAME]] !== $params[$part[Route::NAME]]

                    ) {

                        $current['skip'] = false;

                    }

                    $current['path'] .= $params[$part[Route::NAME]];

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
    protected function definition($name)
    {
        return $this->config->get($name);
    }

    /**
     * @param string $name
     * @param array $params
     * @return string
     */
    public function url($name, array $params = [])
    {
        return rtrim($this->build($name, $params), '/') ?: '/';
    }
}
