<?php

namespace Framework\Service\Resolver;

use ReflectionClass;
use RuntimeException;

trait Builder
{
    /**
     * @param string $name
     * @param array $args
     * @param callable $callback
     * @return object
     */
    protected function build($name, array $args = [], callable $callback = null)
    {
        $class = new ReflectionClass($name);

        if (!$class->hasMethod('__construct')) {
            return $class->newInstanceWithoutConstructor();
        }

        if ($args && !is_string(key($args))) {
            return $class->newInstanceArgs($args);
        }

        $matched = [];
        $params  = $class->getConstructor()->getParameters();

        foreach($params as $param) {
            if (isset($args[$param->name])) {
                $matched[] = $args[$param->name];
                continue;
            }

            if ($param->isOptional()) {
                $matched[] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;
                continue;
            }

            if ($callback && $hint = $param->getClass()) {
                $matched[] = $callback($hint->name);
                continue;
            }

            throw new RuntimeException('Missing required parameter $' . $param->name . ' for ' . $name);
        }

        return $class->newInstanceArgs($params ? $matched : $args);
    }
}
