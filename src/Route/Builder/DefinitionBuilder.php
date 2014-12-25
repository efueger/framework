<?php

namespace Framework\Route\Builder;

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
     * @param array $definition
     * @return Definition
     */
    function add(array $definition);

    /**
     * @param Definition $parent
     * @param array $definition
     * @param array $path
     * @param bool $start
     * @return Definition
     * @throws Exception
     */
    static function addChild(Definition $parent, array $definition, array $path, $start = false);

    /**
     * @param array $definitions
     * @param bool $compile
     * @param bool $recursive
     * @return array
     */
    static function children(array $definitions, $compile = true, $recursive = true);

    /**
     * @param array|Definition $definition
     * @param bool $compile
     * @param bool $recursive
     * @return Definition
     */
    static function definition($definition, $compile = true, $recursive = false);

    /**
     * @param array $tokens
     * @return array
     */
    static function paramMap(array $tokens);

    /**
     * @param array $tokens
     * @param array $constraints
     * @param string $delimiter
     * @return string
     */
    static function regex(array $tokens, array $constraints = [], $delimiter = '/');

    /**
     * @param $pattern
     * @param $delimiter
     * @return array
     * @throws RuntimeException
     */
    static function tokens($pattern, $delimiter = '/');

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    static function url($definition);
}
