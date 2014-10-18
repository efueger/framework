<?php

namespace Framework\Web\Render;

use Framework\View\Model\ModelInterface as View;

interface ListenerInterface
{
    /**
     * @param View $viewModel
     * @return mixed
     */
    function __invoke(View $viewModel = null);
}
