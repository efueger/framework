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
     * @param LayoutModel $layout
     * @param $model
     * @return ViewModel
     */
    public function __invoke(LayoutModel $layout, $model = null)
    {
        if (!$model || !$model instanceof ViewModel || $model instanceof LayoutModel) {
            return $model;
        }

        $layout->child($model);

        return $layout;
    }
}
