<?php

namespace Framework\View\Exception;

use Exception;

interface ListenerInterface
{
    /**
     * @param Exception $exception
     * @return mixed
     */
    function __invoke(Exception $exception);
}
