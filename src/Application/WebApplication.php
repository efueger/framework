<?php

namespace Framework\Application;

interface WebApplication
{
    /**
     *
     */
    const WEB = 'web';

    /**
     * @param array $args
     * @param callable $callback
     * @return callable|mixed|null|object
     */
    public function __invoke(array $args = [], callable $callback = null);
}
