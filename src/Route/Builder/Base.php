<?php
/**
 *
 */

namespace Framework\Route\Builder;

use Framework\Route\Definition\Definition;
use Framework\Route\Definition\RouteDefinition;
use RuntimeException;

trait Base
{
    /**
     *
     */
    use Params;
    use Regex;
    use Tokens;

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
        && $definition[Definition::PARAM_MAP] = static::params($definition[Definition::TOKENS]);

        $recursive && !empty($definition[Definition::CHILDREN])
        && $definition[Definition::CHILDREN] = static::children($definition[Definition::CHILDREN]);

        return $definition instanceof Definition ? $definition : new RouteDefinition($definition);
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
