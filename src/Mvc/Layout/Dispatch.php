<?php

namespace Framework\Mvc\Layout;

use Framework\View\Model\ViewModel;

interface Dispatch
{
    /**
     * @param $model
     * @param ViewModel $layout
     * @return ViewModel
     */
    function __invoke($model, ViewModel $layout = null);
}
