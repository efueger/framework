<?php

namespace Framework\Route\Definition\Builder;

use Framework\Config\Configuration;
use Framework\Route\Definition\Definition;
use Framework\Route\Definition\RouteDefinition;
use Framework\Service\Config\Router\Router;
use RuntimeException;

/**
 * Portions copyright (c) 2013 Ben Scholzen 'DASPRiD'. (http://github.com/DASPRiD/Dash)
 * under the Simplified BSD License (http://opensource.org/licenses/BSD-2-Clause).
 */
class Builder
    implements DefinitionBuilder
{
    /**
     * @var Configuration
     */
    protected $routes;

    /**
     * @param Configuration $routes
     */
    public function __construct(Configuration $routes)
    {
        $this->routes = $routes;
    }

    public function add(array $definition)
    {
        return $this->addChild(
            $this->routes[Args::DEFINITIONS],
            $definition,
            explode('/', $definition[Definition::NAME]),
            function($definition) {
                $this->routes[Args::EVENTS]->add(Args::ROUTE_DISPATCH, new Router($definition));
            }
        );
    }

    /**
     * @param Definition $parent
     * @param array $definition
     * @param array $path
     * @param callable $callback
     * @return Definition
     * @throws RuntimeException
     */
    public static function addChild(Definition $parent, array $definition, array $path, callable $callback = null)
    {
        if ($root = $parent->child($path[0])) {
            return static::addChild($root, $definition, array_slice($path, 1));
        }

        if (isset($path[1])) {
            throw new RuntimeException('Parent definition not found: ' . $definition[Definition::NAME]);
        }

        $definition[Definition::NAME] = $path[0];

        $callback && empty($definition[Definition::ROUTE])
            && $definition[Definition::ROUTE] = '/'
                . (isset($definition[Definition::NAME]) ? $definition[Definition::NAME] : null);

        !$callback && empty($definition[Definition::ROUTE]) && $definition[Definition::ROUTE] = '/' . $path[0];

        $definition = static::definition($definition);

        $parent->add($path[0], $definition);

        $callback && $callback($definition);

        return $definition;
    }

    /**
     * @param array $definitions
     * @return array
     */
    public static function children(array $definitions)
    {
        foreach($definitions as $name => $definition) {
            !$definition instanceof Definition && $definitions[$name] = static::definition($definition);
        }

        return $definitions;
    }

    /**
     * @param array $definition
     * @return Definition
     */
    public static function definition(array $definition)
    {
        if (!isset($definition[Definition::ROUTE])) {
            throw new RuntimeException('Route not specified');
        }

        !isset($definition[Definition::CONSTRAINTS]) && $definition[Definition::CONSTRAINTS] = [];

        !isset($definition[Definition::TOKENS])
                && $definition[Definition::TOKENS] = static::tokens($definition[Definition::ROUTE]);

        !isset($definition[Definition::REGEX])
            && $definition[Definition::REGEX]
                = static::regex($definition[Definition::TOKENS], $definition[Definition::CONSTRAINTS]);

        !isset($definition[Definition::PARAM_MAP])
            && $definition[Definition::PARAM_MAP] = static::paramMap($definition[Definition::TOKENS]);

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
            'parameter' == $token[self::TYPE] && $map['param' . $index++] = $token[self::NAME];
        }

        return $map;
    }

    /**
     * @param array $tokens
     * @param array $constraints
     * @param string $delimiter
     * @return array
     */
    public static function regex(array $tokens, array $constraints = [], $delimiter = '/')
    {
        $delimiter  = preg_quote($delimiter);
        $groupIndex = 1;
        $regex      = '';

        foreach($tokens as $token) {
            if ('literal' === $token[self::TYPE]) {
                $regex .= preg_quote($token[self::LITERAL]);
                continue;
            }

            if ('parameter' === $token[self::TYPE]) {
                $groupName = '?P<param' . $groupIndex++ . '>';

                if (isset($constraints[$token[self::NAME]])) {
                    $regex .= '(' . $groupName . $constraints[$token[self::NAME]] . ')';
                    continue;
                }

                if (null === $token[self::DELIMITERS]) {
                    $regex .= '(' . $groupName . '[^' . $delimiter . ']+)';
                    continue;
                }

                $regex .= '(' . $groupName . '[^' . $token[self::DELIMITERS] . ']+)';

                continue;
            }

            if ('optional-start' === $token[self::TYPE]) {
                $regex .= '(?:';
                continue;
            }

            if ('optional-end' === $token[self::TYPE]) {
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
                $tokens[] = array('optional-start');
                $level++;
                continue;
            }

            if (']' === $matches['token']) {
                $tokens[] = array('optional-end');

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
     * @param array $definition
     * @return Definition
     */
    public function __invoke(array $definition)
    {
        return static::definition($definition);
    }
}
