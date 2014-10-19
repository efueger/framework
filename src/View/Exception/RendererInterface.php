<?php

namespace Framework\View\Exception;

use Exception;

interface RendererInterface
{
    /**
     * @param Exception $exception
     * @return mixed
     */
    function __invoke(Exception $exception);
}
