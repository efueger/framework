<?php

namespace Framework\Controller\Exception;

interface ExceptionInterface
{
    /**
     *
     */
    const EXCEPTION = 'Controller\Exception';

    /**
     *
     */
    const REQUEST = 'request';

    /**
     *
     */
    const RESPONSE = 'response';

    /**
     * @param callable $listener
     * @param array $args
     * @return mixed
     */
    function __invoke(callable $listener, array $args = []);
}