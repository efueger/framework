<?php

namespace Framework\Service\Resolver;

use ReflectionFunction;
use ReflectionMethod;
use RuntimeException;

trait SignalTrait
{
    /**
     * @param callable $config
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected function signal(callable $config, array $args = [], callable $callback = null)
    {
        $callable = null;
        $matched  = [];
        $method   = '__invoke';
        $params   = null;

        if ($args && !is_string(key($args))) {
            return call_user_func_array($config, $args);
        }

        if (is_array($config)) {
            isset($config[1]) && $method = $config[1];
            $config = $config[0];
        }

        if (is_string($config) && !class_exists($config)) {
            $static = explode('::', $config);
            if (isset($static[1])) {
                list($config, $method) = $static;
            } else {
                $params   = (new ReflectionFunction($config))->getParameters();
                $callable = $config;
            }
        }

        !$params && $params = (new ReflectionMethod($config, $method))->getParameters();

        foreach($params as $param) {
            if (isset($args[$param->name])) {
                $matched[] = $args[$param->name];
                continue;
            }

            if (ResolverArgs::ARGS === $param->name) {
                $matched[] = $args;
                continue;
            }

            if ($callback && $match = $callback($param->name)) {
                $matched[] = $match;
                continue;
            }

            if ($param->isDefaultValueAvailable()) {
                $matched[] = $param->getDefaultValue();
                continue;
            }

            if ($param->isArray()) {
                $matched[] = [];
                continue;
            }

            if (!$param->isOptional()) {
                throw new RuntimeException('Missing required parameter ' . $param->name);
            }

            $matched[] = null;
        }

        return call_user_func_array($callable ?: [$config, $method], $params ? $matched : $args);
    }
}
