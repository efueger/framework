<?php
/**
 *
 */

namespace Mvc5\Route\Builder;

use Exception;
use Mvc5\Route\Definition\Definition;
use RuntimeException;

interface DefinitionBuilder
{
    /**
     * @param Definition $parent
     * @param array|Definition $definition
     * @param array $path
     * @param bool $start
     * @return Definition
     * @throws Exception
     */
    static function addChild(Definition $parent, $definition, array $path, $start = false);

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
    static function params(array $tokens);

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

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    function __invoke($definition);
}
