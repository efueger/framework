<?php
/**
 *
 */

namespace Framework\Mvc\Layout;

use Framework\View\Layout\LayoutModel;
use Framework\View\Model\ViewModel;

interface Dispatch
{
    /**
     * @param LayoutModel $layout
     * @param $model
     * @return ViewModel
     */
    function __invoke(LayoutModel $layout, $model = null);
}
