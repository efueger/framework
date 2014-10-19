<?php

namespace Framework\View\Exception;

use Exception;

interface RendererInterface
{
    /**
     * @param Exception $exception
     * @param ViewModelInterface $viewModel
     * @return mixed
     */
    function __invoke(Exception $exception, ViewModelInterface $viewModel);
}
