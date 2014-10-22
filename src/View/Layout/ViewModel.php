<?php

namespace Framework\View\Layout;

use Framework\View\Model\BaseModel;
use Framework\View\ViewPlugin;

class ViewModel
    implements Layout, LayoutViewModel
{
    /**
     *
     */
    use BaseModel;
    use ViewPlugin;
}
