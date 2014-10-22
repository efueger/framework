<?php

namespace Framework\Route\Definition\Builder;

use Framework\Config\Configuration;
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
     * @param array $definitions
     * @return array
     */
    static function children(array $definitions);

    /**
     * @param $definition
     * @return Definition
     */
    static function definition($definition);

    /**
     * @param array $definitions
     * @return Configuration
     */
    static function definitions(array $definitions);

    /**
     * @param array $tokens
     * @return array
     */
    static function paramMap(array $tokens);

    /**
     * @param array $tokens
     * @param string $delimiter
     * @return array
     */
    static function regex($tokens, $delimiter = '/');

    /**
     * @param $pattern
     * @param $delimiter
     * @return array
     * @throws RuntimeException
     */
    static function tokens($pattern, $delimiter = '/');
}
