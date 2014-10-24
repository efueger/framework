<?php

namespace Framework\View\Layout;

use Framework\View\Model\Base;
use Framework\View\ViewPlugin;

class Model
    implements Layout, LayoutModel
{
    /**
     *
     */
    use Base;
    use ViewPlugin;
}
