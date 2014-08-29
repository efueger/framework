<?php

namespace Framework\Route\Definition\Builder;

use Framework\Config\ConfigInterface;
use Framework\Route\Definition\Definition;
use RuntimeException;

interface BuilderInterface
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
    public static function children(array $definitions);

    /**
     * @param $definition
     * @return Definition
     */
    public static function definition($definition);

    /**
     * @param array $definitions
     * @return ConfigInterface
     */
    public static function definitions(array $definitions);

    /**
     * @param array $tokens
     * @return array
     */
    public static function paramMap(array $tokens);

    /**
     * @param array $tokens
     * @param string $delimiter
     * @return array
     */
    public static function regex($tokens, $delimiter = '/');

    /**
     * @param $pattern
     * @param $delimiter
     * @return array
     * @throws RuntimeException
     */
    public static function tokens($pattern, $delimiter = '/');
}
