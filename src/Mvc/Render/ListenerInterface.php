<?php

namespace Framework\Mvc\Render;

use Framework\View\Model\ModelInterface as View;

interface ListenerInterface
{
    /**
     * @param View $viewModel
     * @param callable $callback
     * @return mixed
     */
    function __invoke(View $viewModel = null, callable $callback = null);
}
