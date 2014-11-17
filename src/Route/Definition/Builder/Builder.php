<?php

namespace Framework\Route\Definition\Builder;

use Exception;
use Framework\Route\Definition\Definition;
use Framework\Route\Definition\RouteDefinition;
use RuntimeException;

/**
 * Portions copyright (c) 2013 Ben Scholzen 'DASPRiD'. (http://github.com/DASPRiD/Dash)
 * under the Simplified BSD License (http://opensource.org/licenses/BSD-2-Clause).
 */
class Builder
    implements DefinitionBuilder
{
    /**
     * @param Definition $parent
     * @param array $definition
     * @param array $path
     * @param callable $callback
     * @param bool $start
     * @return Definition
     * @throws Exception
     */
    public static function add(
        Definition $parent, array $definition, array $path, callable $callback = null, $start = false
    ) {
        $root = $parent->child($path[0]);

        if (!$root) {
            if (isset($path[1])) {
                throw new Exception('Parent definition not found: ' . $definition[Definition::NAME]);
            }

            return $callback($parent, static::definition($definition), $path[0], $start);
        }

        array_shift($path);

        !isset($path[1]) && $definition[Definition::ROUTE] = '/' . $path[0]
            . (isset($definition[Definition::ROUTE]) ? $definition[Definition::ROUTE] : null);

        return static::add($root, $definition, $path, $callback);
    }

    /**
     * @param array $definitions
     * @return array
     */
    public static function children(array $definitions)
    {
        foreach($definitions as $name => $definition) {
            if (!$definition instanceof Definition) {
                $definitions[$name] = static::definition($definition);
            }
        }

        return $definitions;
    }

    /**
     * @param array $definition
     * @return Definition
     */
    public static function definition(array $definition)
    {
        $tokens = isset($definition[Definition::ROUTE]) ? static::tokens($definition[Definition::ROUTE]) : [];

        $definition = array_merge(
            $definition,
            [
                Definition::PARAM_MAP => static::paramMap($tokens),
                Definition::REGEX     => static::regex($tokens),
                Definition::TOKENS    => $tokens
            ]
        );

        !empty($definition[Definition::CHILDREN])
            && $definition[Definition::CHILDREN] = static::children($definition[Definition::CHILDREN]);

        return new RouteDefinition($definition);
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
            if ('parameter' == $token[self::TYPE]) {
                $map['param' . $index++] = $token[self::NAME];
            }
        }

        return $map;
    }

    /**
     * @param array $tokens
     * @param string $delimiter
     * @return array
     */
    public static function regex($tokens, $delimiter = '/')
    {
        $groupIndex = 1;
        $quotedDelimiter = preg_quote($delimiter);
        $regex = '';

        foreach($tokens as $token) {
            switch($token[self::TYPE]) {
                case 'literal':

                    $regex .= preg_quote($token[self::LITERAL]);

                    break;
                case 'parameter':

                    $groupName = '?P<param' . $groupIndex++ . '>';

                    switch(true) {
                        default:

                            $regex .= '(' . $groupName . '[^' . $token[self::DELIMITERS] . ']+)';

                            break;

                        case isset($constraints[$token[self::NAME]]):

                            $regex .= '(' . $groupName . $constraints[$token[self::NAME]] . ')';

                            break;

                        case null === $token[self::DELIMITERS]:

                            $regex .= '(' . $groupName . '[^' . $quotedDelimiter . ']+)';

                            break;
                    }

                    break;
                case 'optional-start':

                    $regex .= '(?:';

                    break;
                case 'optional-end':

                    $regex .= ')?';

                    break;
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
        $length = strlen($subject);
        $tokens = [];
        $level = 0;
        $quotedDelimiter = preg_quote($delimiter);

        while($currentPos < $length) {

            preg_match('(\G(?P<literal>[^:{\[\]]*)(?P<token>[:\[\]]|$))', $subject, $matches, 0, $currentPos);

            $currentPos += strlen($matches[0]);

            if (!empty($matches['literal'])) {
                $tokens[] = ['literal', $matches['literal']];
            }

            switch(true) {
                default:
                    break 2;

                case $matches['token'] === ':':

                    $pattern = '(\G(?P<name>[^:' . $quotedDelimiter . '{\[\]]+)(?:{(?P<delimiters>[^}]+)})?:?)';

                    $result = preg_match($pattern, $subject, $matches, 0, $currentPos);

                    if (!$result) {
                        throw new RuntimeException('Found empty parameter name');
                    }

                    $tokens[] = [
                        'parameter',
                        $matches['name'],
                        isset($matches['delimiters']) ? $matches['delimiters'] : null
                    ];

                    $currentPos += strlen($matches[0]);

                    break;

                case $matches['token'] === '[':

                    $tokens[] = array('optional-start');

                    $level++;

                    break;

                case $matches['token'] === ']':

                    $tokens[] = array('optional-end');

                    $level--;

                    if ($level < 0) {
                        throw new RuntimeException('Found closing bracket without matching opening bracket');
                    }

                    break;
            }
        }

        if ($level > 0) {
            throw new RuntimeException('Found unbalanced brackets');
        }

        return $tokens;
    }

    /**
     * @param array $definition
     * @return Definition
     */
    public function __invoke(array $definition)
    {
        return static::definition($definition);
    }
}
