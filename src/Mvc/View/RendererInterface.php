<?php

namespace Framework\Mvc\View;

use Framework\View\Model\ModelInterface as View;

interface RendererInterface
{
    /**
     * @param View $viewModel
     * @return mixed
     */
    function __invoke(View $viewModel = null);
}
