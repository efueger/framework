<?php

namespace Framework\View\Layout;

use Framework\View\Model\ModelTrait;
use Framework\View\PluginTrait;

class ViewModel
    implements Layout, LayoutViewModel
{
    /**
     *
     */
    use ModelTrait;
    use PluginTrait;
}
