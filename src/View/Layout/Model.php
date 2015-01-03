<?php
/**
 *
 */

namespace Framework\View\Layout;

use Framework\View\Model\Base;
use Framework\View\Model\Plugin;
use Framework\View\ViewPlugin;

class Model
    implements LayoutModel, Plugin
{
    /**
     *
     */
    use Base;
    use ViewPlugin;
}
