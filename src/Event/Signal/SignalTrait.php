<?php

namespace Framework\Event\Signal;

use Closure;
use Framework\Event\Args\ArgsInterface as EventArgs;
use ReflectionMethod;

trait SignalTrait
{
    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    public function signal(callable $listener, array $args = [])
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

        $opts = isset($args[0]) && $args[0] instanceof EventArgs ? $args[0]->args() : $args;

        foreach($params as $param) {
            if (isset($opts[$param->name])) {
                $matched[] = $opts[$param->name];
            }
        }

        return call_user_func_array($listener, !$matched && $listener instanceof Closure ? $args : $matched);
    }
}
