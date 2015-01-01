<?php

namespace Framework\Route\Builder;

use Framework\Route\Definition\Definition;
use Framework\Route\Definition\RouteDefinition;
use RuntimeException;

/**
 * Portions copyright (c) 2013 Ben Scholzen 'DASPRiD'. (http://github.com/DASPRiD/Dash)
 * under the Simplified BSD License (http://opensource.org/licenses/BSD-2-Clause).
 */
trait Base
{
    /**
     * @param Definition $parent
     * @param array|Definition $definition
     * @param array $path
     * @param bool $start
     * @return Definition
     * @throws RuntimeException
     */
    public static function addChild(Definition $parent, $definition, array $path, $start = false)
    {
        if ($root = $parent->child($path[0])) {
            return static::addChild($root, $definition, array_slice($path, 1));
        }

        if (isset($path[1])) {
            throw new RuntimeException('Parent definition not found: ' . $definition[Definition::NAME]);
        }

        $definition[Definition::NAME] = $path[0];

        $start && empty($definition[Definition::ROUTE]) && isset($definition[Definition::NAME])
        && $definition[Definition::ROUTE] = $definition[Definition::NAME];

        !$start && empty($definition[Definition::ROUTE]) && $definition[Definition::ROUTE] = '/' . $path[0];

        $definition = static::definition($definition);

        $parent->add($path[0], $definition);

        return $definition;
    }

    /**
     * @param array $definitions
     * @param bool $compile
     * @param bool $recursive
     * @return array
     */
    public static function children(array $definitions, $compile = true, $recursive = true)
    {
        foreach($definitions as $name => $definition) {
            !$definition instanceof Definition && $definitions[$name]
                = static::definition($definition, $compile, $recursive);
        }

        return $definitions;
    }

    /**
     * @param array|Definition $definition
     * @param bool $compile
     * @param bool $recursive
     * @return Definition
     */
    public static function definition($definition, $compile = true, $recursive = false)
    {
        if (empty($definition[Definition::ROUTE])) {
            throw new RuntimeException('Route not specified');
        }

        !isset($definition[Definition::CONSTRAINTS]) && $definition[Definition::CONSTRAINTS] = [];

        empty($definition[Definition::TOKENS])
        && $definition[Definition::TOKENS] = static::tokens($definition[Definition::ROUTE]);

        $compile && empty($definition[Definition::REGEX]) && $definition[Definition::REGEX]
            = static::regex($definition[Definition::TOKENS], $definition[Definition::CONSTRAINTS]);

        empty($definition[Definition::PARAM_MAP])
        && $definition[Definition::PARAM_MAP] = static::paramMap($definition[Definition::TOKENS]);

        $recursive && !empty($definition[Definition::CHILDREN])
        && $definition[Definition::CHILDREN] = static::children($definition[Definition::CHILDREN]);

        return $definition instanceof Definition ? $definition : new RouteDefinition($definition);
    }

    /**
     * @param array $tokens
     * @return array
     */
    public static function paramMap(array $tokens)
    {
        $index = 1;
        $map   = [];

        foreach($tokens as $token) {
            'parameter' == $token[Args::TYPE] && $map['param' . $index++] = $token[Args::NAME];
        }

        return $map;
    }

    /**
     * @param array $tokens
     * @param array $constraints
     * @param string $delimiter
     * @return string
     */
    public static function regex(array $tokens, array $constraints = [], $delimiter = '/')
    {
        $delimiter  = preg_quote($delimiter);
        $groupIndex = 1;
        $regex      = '';

        foreach($tokens as $token) {
            if ('literal' === $token[Args::TYPE]) {
                $regex .= preg_quote($token[Args::LITERAL]);
                continue;
            }

            if ('parameter' === $token[Args::TYPE]) {
                $groupName = '?P<param' . $groupIndex++ . '>';

                if (isset($constraints[$token[Args::NAME]])) {
                    $regex .= '(' . $groupName . $constraints[$token[Args::NAME]] . ')';
                    continue;
                }

                if (null === $token[Args::DELIMITERS]) {
                    $regex .= '(' . $groupName . '[^' . $delimiter . ']+)';
                    continue;
                }

                $regex .= '(' . $groupName . '[^' . $token[Args::DELIMITERS] . ']+)';

                continue;
            }

            if ('optional-start' === $token[Args::TYPE]) {
                $regex .= '(?:';
                continue;
            }

            if ('optional-end' === $token[Args::TYPE]) {
                $regex .= ')?';
                continue;
            }
        }

        return $regex;
    }

    /**
     * @param $subject
     * @param $delimiter
     * @return array
     * @throws RuntimeException
     */
    public static function tokens($subject, $delimiter = '/')
    {
        $currentPos = 0;
        $delimiter  = preg_quote($delimiter);
        $length     = strlen($subject);
        $level      = 0;
        $tokens     = [];

        while($currentPos < $length) {

            preg_match('(\G(?P<literal>[^:{\[\]]*)(?P<token>[:\[\]]|$))', $subject, $matches, 0, $currentPos);

            $currentPos += strlen($matches[0]);

            !empty($matches['literal']) && $tokens[] = ['literal', $matches['literal']];

            if (':' === $matches['token']) {
                $pattern = '(\G(?P<name>[^:' . $delimiter . '{\[\]]+)(?:{(?P<delimiters>[^}]+)})?:?)';
                $result  = preg_match($pattern, $subject, $matches, 0, $currentPos);

                if (!$result) {
                    throw new RuntimeException('Found empty parameter name');
                }

                $tokens[] = [
                    'parameter',
                    $matches['name'],
                    isset($matches['delimiters']) ? $matches['delimiters'] : null
                ];

                $currentPos += strlen($matches[0]);

                continue;
            }

            if ('[' === $matches['token']) {
                $tokens[] = ['optional-start'];
                $level++;
                continue;
            }

            if (']' === $matches['token']) {
                $tokens[] = ['optional-end'];

                $level--;

                if ($level < 0) {
                    throw new RuntimeException('Found closing bracket without matching opening bracket');
                }
                continue;
            }
        }

        if ($level > 0) {
            throw new RuntimeException('Found unbalanced brackets');
        }

        return $tokens;
    }

    /**
     * @param array|Definition $definition
     * @return Definition
     */
    public static function url($definition)
    {
        return static::definition($definition, false);
    }
}
