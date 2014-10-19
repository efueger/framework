<?php

namespace Framework\View\Layout;

use Framework\View\Model\ModelTrait;
use Framework\View\PluginTrait;

class ViewModel
    implements LayoutInterface, ViewModelInterface
{
    /**
     *
     */
    use ModelTrait;
    use PluginTrait;
}
