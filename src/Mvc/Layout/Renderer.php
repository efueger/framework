<?php

namespace Framework\Mvc\Layout;

use Framework\View\Layout\Layout;
use Framework\View\Model\ViewModel;

class Renderer
    implements Dispatch
{
    /**
     * @param $model
     * @param ViewModel $layout
     * @return ViewModel
     */
    public function __invoke($model = null, ViewModel $layout = null)
    {
        if (!$model || !$layout) {
            return $model;
        }

        if (!$model instanceof ViewModel || $model instanceof Layout) {
            return $model;
        }

        $layout->setContent($model);

        return $layout;
    }
}
