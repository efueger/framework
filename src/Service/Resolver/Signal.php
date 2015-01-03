<?php
/**
 *
 */

namespace Framework\Service\Resolver;

use ReflectionFunction;
use ReflectionMethod;
use RuntimeException;

trait Signal
{
    /**
     * @param callable|object $config
     * @param array $args
     * @param callable $callback
     * @return mixed
     */
    protected function signal(callable $config, array $args = [], callable $callback = null)
    {
        if ($args && !is_string(key($args))) {
            return call_user_func_array($config, $args);
        }

        $function = null;
        $matched  = [];
        $method   = '__invoke';
        $params   = [];

        if (is_array($config)) {
            list($config, $method) = $config;
        }

        if (is_string($config) && !class_exists($config)) {
            $static = explode('::', $config);
            if (isset($static[1])) {
                list($config, $method) = $static;
            } else {
                $params   = (new ReflectionFunction($config))->getParameters();
                $function = $config;
            }
        }

        !$function && $params = (new ReflectionMethod($config, $method))->getParameters();

        foreach($params as $param) {
            if (isset($args[$param->name])) {
                $matched[] = $args[$param->name];
                continue;
            }

            if (Args::ARGS === $param->name) {
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

            if (!$param->isOptional()) {
                throw new RuntimeException(
                    'Missing required parameter $' . $param->name
                    . ' for ' . ($function ?: is_string($config) ? $config : get_class($config))
                );
            }

            $matched[] = null;
        }

        return call_user_func_array($function ?: [$config, $method], $params ? $matched : $args);
    }
}
