<?php

namespace Framework\Event\Signal;

interface SignalInterface
{
    /**
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    public function signal(callable $listener, array $options = []);
}
