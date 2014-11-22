<?php

namespace Framework\Route\Definition\Builder;

use Exception;
use Framework\Route\Definition\Definition;
use RuntimeException;

interface DefinitionBuilder
{
    /**
     *
     */
    const TYPE = 0;

    /**
     *
     */
    const NAME = 1;

    /**
     *
     */
    const LITERAL = 1;

    /**
     *
     */
    const DELIMITERS = 2;

    /**
     * @param Definition $parent
     * @param array $definition
     * @param array $path
     * @param callable $callback
     * @return Definition
     * @throws Exception
     */
    static function add(Definition $parent, array $definition, array $path, callable $callback = null);

    /**
     * @param array $definitions
     * @return array
     */
    static function children(array $definitions);

    /**
     * @param array $definition
     * @return Definition
     */
    static function definition(array $definition);

    /**
     * @param array $tokens
     * @return array
     */
    static function paramMap(array $tokens);

    /**
     * @param array $tokens
     * @param array $constraints
     * @param string $delimiter
     * @return array
     */
    static function regex(array $tokens, array $constraints = [], $delimiter = '/');

    /**
     * @param $pattern
     * @param $delimiter
     * @return array
     * @throws RuntimeException
     */
    static function tokens($pattern, $delimiter = '/');
}
