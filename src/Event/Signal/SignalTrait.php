<?php

namespace Framework\Event\Signal;

use Closure;
use ReflectionMethod;

trait SignalTrait
{
    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    protected function signal(callable $listener, array $args = [])
    {
        if (!$args) {
            return $listener();
        }

        $method = '__invoke';

        if (is_array($listener)) {
            if (is_string($listener[0])) {
                return call_user_func($listener, $args);
            }

            $method   = isset($listener[1]) ? $listener[1] : $method;
            $listener = $listener[0];
        }

        $params = (new ReflectionMethod($listener, $method))->getParameters();

        $matched = [];

        foreach($params as $param) {
            if (SignalInterface::ARGUMENTS === $param->name && !isset($args[$param->name])) {
                $matched[] = $args;
                continue;
            }

            if (isset($args[$param->name])) {
                $matched[] = $args[$param->name];
            }
        }

        if ($listener instanceof Closure && is_string(key($args))) {
            $args = [[SignalInterface::ARGS => $args]];
        }

        return call_user_func_array($listener, $params ? $matched : $args);
    }
}
