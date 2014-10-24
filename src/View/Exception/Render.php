<?php

namespace Framework\View\Exception;

use Exception;

interface Render
{
    /**
     * @param Exception $exception
     * @param ExceptionViewModel $viewModel
     * @return mixed
     */
    function __invoke(Exception $exception, ExceptionViewModel $viewModel);
}
