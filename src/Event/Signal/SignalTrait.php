<?php

namespace Framework\Event\Signal;

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

        $method = SignalInterface::INVOKE;

        if (is_array($listener)) {
            if (is_string($listener[0])) {
                return call_user_func($listener, $args);
            }

            $method = isset($listener[1]) ? $listener[1] : $method;

            $listener = $listener[0];
        }

        $matched = [];
        $params  = (new ReflectionMethod($listener, $method))->getParameters();

        foreach($params as $param) {
            if (isset($args[$param->name])) {
                $matched[] = $args[$param->name];
                continue;
            }

            if (SignalInterface::ARGUMENTS === $param->name && !isset($args[$param->name])) {
                $matched[] = $args;
                continue;
            }

            $matched[] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : $param->isArray() ? [] : null;
        }

        return call_user_func_array($listener, $params ? $matched : $args);
    }
}
