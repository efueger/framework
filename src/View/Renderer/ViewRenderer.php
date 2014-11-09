<?php

namespace Framework\View\Renderer;

use Framework\View\Model\ViewModel;

interface ViewRenderer
{
    /**
     * @param ViewModel $model
     * @return mixed
     */
    function __invoke(ViewModel $model);
}
