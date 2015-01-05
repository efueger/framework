<?php
/**
 *
 */

namespace Framework\View\Renderer;

use Framework\View\Model\ViewModel;

interface ViewRenderer
{
    /**
     * @param ViewModel $model
     * @return string
     */
    function __invoke(ViewModel $model);
}
