<?php

namespace Framework\Service\Resolver;

use ReflectionFunction;
use ReflectionMethod;

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
        if (!$args) {
            return $config();
        }

        $method = '__invoke';

        if (is_array($config)) {
            if (is_string($config[0])) {
                return call_user_func($config, $args);
            }

            $method = isset($config[1]) ? $config[1] : $method;
            $config = $callback ? $callback($config[0]) : $config[0];
        }

        $callable = null;
        $matched  = [];
        $params   = null;

        if (is_string($config) && !class_exists($config)) {
            $static = explode(ResolverInterface::CALLABLE_STRING, $config);
            if ($static && isset($static[1])) {
                list($config, $method) = $static;
            } else {
                $params   = (new ReflectionFunction($config))->getParameters();
                $callable = $config;
            }
        }

        !$callable && $params = (new ReflectionMethod($config, $method))->getParameters();

        foreach($params as $param) {
            if (isset($args[$param->name])) {
                $matched[] = $args[$param->name];
                continue;
            }

            if (ResolverInterface::ARGS === $param->name && !isset($args[$param->name])) {
                $matched[] = $args;
                continue;
            }

            $matched[] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : $param->isArray() ? [] : null;
        }

        return call_user_func_array($callable ?: [$config, $method], $params ? $matched : $args);
    }
}
