<?php

namespace Framework\Event\Signal;

interface SignalInterface
{
    /**
     *
     */
    const ARGS = '__args__';

    /**
     * @param callable $listener
     * @param array $options
     * @return mixed
     */
    public function signal(callable $listener, array $options = []);
}
