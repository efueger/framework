<?php
/**
 *
 */

namespace Framework\Mvc\Layout;

use Framework\View\Layout\LayoutModel;
use Framework\View\Model\ViewModel;

class Renderer
    implements Dispatch
{
    /**
     * @param $model
     * @param $layout
     * @return ViewModel
     */
    public function __invoke($model = null, ViewModel $layout = null)
    {
        if (!$model || !$layout || !$layout instanceof LayoutModel) {
            return $model;
        }

        if (!$model instanceof ViewModel || $model instanceof LayoutModel) {
            return $model;
        }

        $layout->child($model);

        return $layout;
    }
}
