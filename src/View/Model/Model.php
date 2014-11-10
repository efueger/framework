<?php

namespace Framework\View\Model;

use ArrayAccess;
use Framework\View\ViewPlugin;

class Model
    implements ArrayAccess, ViewModel, Plugin
{
    /**
     *
     */
    use Base;
    use ViewPlugin;
}
