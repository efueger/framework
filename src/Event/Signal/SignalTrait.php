<?php

namespace Framework\Event\Signal;

use Closure;
use Framework\Event\Args\ArgsInterface as EventArgs;
use ReflectionMethod;

trait SignalTrait
{
    /**
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    public function signal(callable $listener, array $options = [])
    {
        if (!$options) {
            return $listener();
        }

        $method = '__invoke';

        if (is_array($listener)) {
            if (is_string($listener[0])) {
                return call_user_func($listener, $options);
            }

            $method   = isset($listener[1]) ? $listener[1] : $method;
            $listener = $listener[0];
        }

        $method = new ReflectionMethod($listener, $method);

        $args   = [];
        $params = $options[0] instanceof EventArgs ? $options[0]->args() : $options;
        $params = array_change_key_case($params);

        foreach($method->getParameters() as $arg) {
            $name = strtolower($arg->name);
            if (isset($params[$name])) {
                $args[] = $params[$name];
            }
        }

        return call_user_func_array($listener, !$args && $listener instanceof Closure ? $options : $args);
    }
}
