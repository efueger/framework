<?php

namespace Framework\View\Layout;

use Framework\View\Model\ModelTrait;
use Framework\View\Plugin\PluginTrait;

class ViewModel
    implements LayoutInterface, ViewModelInterface
{
    /**
     *
     */
    use ModelTrait,
        PluginTrait;
}
